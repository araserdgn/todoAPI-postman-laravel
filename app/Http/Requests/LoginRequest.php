<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email alanı boş olamaz.',
            'email.email' => 'Email formatına uygun değil.',
            'password.required'=>'Şifre alanı boş bırakılamaz.',
            'password.min'=>'Şifre alanı minimum 6 karakter olmalıdır.'
        ];
    }
}
