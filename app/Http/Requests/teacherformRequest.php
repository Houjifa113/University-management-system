<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class teacherformRequest extends FormRequest
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
        $teacher = $this->route('teacherlist');
        $isCreatingTeacher = $this->isMethod('post');

        return [
            'name' => [
                $isCreatingTeacher ? 'required' : 'nullable',
                'string',
                'min:5',
                'max:255',
                Rule::unique('teacherlists', 'name')->ignore($teacher),
            ],
            'email' => [
                $isCreatingTeacher ? 'required' : 'nullable',
                'email',
                'max:255',
                Rule::unique('teacherlists', 'email')->ignore($teacher),
            ],
            'password' => [$isCreatingTeacher ? 'required' : 'nullable', 'string', 'min:5', 'max:20', 'confirmed'],
            'department' => [$isCreatingTeacher ? 'required' : 'nullable', 'string', 'max:255'],
            'image' => [$isCreatingTeacher ? 'required' : 'nullable', 'file', 'image', 'mimes:jpeg,jpg,png,gif', 'max:3072'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 5 characters.',
            'name.unique' => 'This name is already registered.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'This email is already registered. Please use a different email.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 5 characters.',
            'password.max' => 'Password must not exceed 20 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'department.required' => 'Department is required.',
            'image.required' => 'Please choose an image.',
            'image.uploaded' => 'The image could not be uploaded. Choose a JPG, PNG, or GIF image smaller than 3 MB and try again.',
            'image.file' => 'Please choose a valid image file.',
            'image.image' => 'The selected file must be an image.',
            'image.mimes' => 'Please choose a JPG, PNG, or GIF image.',
            'image.max' => 'The image must not be larger than 3 MB.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $input = [];

        if ($this->input('email') !== null) {
            $input['email'] = strtolower(trim((string) $this->input('email')));
        }

        if ($this->input('password') !== null) {
            $input['password'] = trim((string) $this->input('password'));
        }

        $this->merge($input);
    }
}
