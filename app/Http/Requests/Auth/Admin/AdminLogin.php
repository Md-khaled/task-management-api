<?php

namespace App\Http\Requests\Auth\Admin;

use App\Responses\JSResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AdminLogin extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }
    protected function failedValidation(Validator $validator): void
    {
        if ($this->expectsJson()) {
            JSResponse::validationError($validator->errors());
        }
        parent::failedValidation($validator);
    }
}
