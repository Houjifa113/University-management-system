<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StudentFormRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('put') && Auth::guard('student')->check()) {
            return [
                'password' => ['nullable', 'string', 'min:5', 'max:20', 'confirmed'],
                'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:20480'],
            ];
        }

        if ($this->isMethod('put')) {
            return [
                'username' => ['nullable', 'string', 'min:5', 'max:20'],
                'email' => ['nullable', 'email', Rule::unique('student_lists', 'email')->ignore($this->route('student')->id)],
                'password' => ['nullable', 'string', 'min:5', 'max:20', 'confirmed'],
                'gender' => ['nullable', 'in:Male,Female,Other'],
                'designation' => ['nullable', 'not_in:Not Selected'],
                'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:20480'],
            ];
        }

        return [
            'username' => ['required', 'string', 'min:5', 'max:20'],
            'email' => ['required', 'email', 'unique:student_lists,email'],
            'password' => ['required', 'string', 'min:5', 'max:20'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'designation' => ['required', 'not_in:Not Selected'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:20480'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username is required',
            'username.min' => 'Username must be at least 5 characters',
            'username.max' => 'Username must not exceed 20 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 5 characters',
            'password.max' => 'Password must not exceed 20 characters',
            'gender.required' => 'Gender is required',
            'gender.in' => 'Gender must be either Male, Female, or Other',
            'designation.required' => 'Department is required',
            'designation.not_in' => 'Please select a valid department',
            'image.image' => 'File must be an image',
            'image.mimes' => 'Image must be a JPEG, PNG, or GIF file',
            'image.max' => 'Image size must not exceed 20MB',
        ];
    }

    protected function prepareForValidation(): void
    {
        $input = [];

        if ($this->input('email') !== null) {
            $input['email'] = strtolower(trim((string) $this->input('email')));
        }

        // Keep an empty update password as null so the nullable validation
        // rule works and the current password is not replaced.
        if ($this->input('password') !== null) {
            $input['password'] = trim((string) $this->input('password'));
        }

        $this->merge($input);
    }
}
