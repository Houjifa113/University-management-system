<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\ValidationException;

class ImportStudentCsvRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string|File>>
     */
    public function rules(): array
    {
        return [
            'student_data_upload' => [
                'required',
                File::types(['csv', 'txt'])->max('5mb'),
            ],
        ];
    }

    /**
     * Read and validate the student rows from the uploaded CSV file.
     *
     * @return array<int, array{username: string, email: string, gender: string, department: string}>
     */
    public function students(): array
    {
        $file = fopen($this->file('student_data_upload')->getRealPath(), 'r');
        $headers = fgetcsv($file);

        if ($headers === false) {
            fclose($file);

            throw ValidationException::withMessages([
                'student_data_upload' => 'The CSV file is empty.',
            ]);
        }

        $headers[0] = preg_replace('/^\xEF\xBB\xBF/', '', $headers[0]);

        if ($headers !== ['username', 'email', 'gender', 'department']) {
            fclose($file);

            throw ValidationException::withMessages([
                'student_data_upload' => 'The CSV header must be: username,email,gender,department.',
            ]);
        }

        $students = [];
        $emailsInFile = [];
        $errors = [];
        $rowNumber = 1;

        while (($row = fgetcsv($file)) !== false) {
            $rowNumber++;

            if ($row === [null]) {
                continue;
            }

            if (count($row) !== 4) {
                $errors[] = "Row {$rowNumber} must have username, email, gender, and department.";

                continue;
            }

            $studentData = [
                'username' => trim($row[0]),
                'email' => strtolower(trim($row[1])),
                'gender' => trim($row[2]),
                'department' => trim($row[3]),
            ];

            $validator = Validator::make($studentData, [
                'username' => ['required', 'string', 'min:5', 'max:20'],
                'email' => ['required', 'email', Rule::unique('studentlists', 'email')],
                'gender' => ['required', 'in:Male,Female,Other'],
                'department' => ['required', 'in:SWE,BA,PM'],
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    $errors[] = "Row {$rowNumber}: {$error}";
                }

                continue;
            }

            if (in_array($studentData['email'], $emailsInFile, true)) {
                $errors[] = "Row {$rowNumber}: this email is duplicated in the CSV file.";

                continue;
            }

            $emailsInFile[] = $studentData['email'];
            $students[] = $studentData;
        }

        fclose($file);

        if ($errors !== []) {
            throw ValidationException::withMessages([
                'student_data_upload' => $errors,
            ]);
        }

        if ($students === []) {
            throw ValidationException::withMessages([
                'student_data_upload' => 'The CSV file has no student rows to import.',
            ]);
        }

        return $students;
    }
}
