<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //! Bunu true yapman lazım kii Postmanda felan hata vermesin dye, giriş yapılıp yapılmadı kontrolu bu
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:6'
        ];

    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name alanını doldurmak zorundasın.',
            'name.string' => 'Text tipini string yapmalısın',
            'name.max' => 'Max 255 karakterde olmalıdır.',
            'email.required' => 'Email alanını doldurmak zorundasınız.',
            'email.string' => 'Email alanı tip string olmalıdır.',
            'email.unique' => 'Email zaten kayıtlıdır.',
            'email.email' => 'Geçersiz email türü.',
            'password.required' => 'Şifre alanı boş bırakılamaz',
            'password.min'=> 'Şifre en az 6 karakterden olusmalıdır'
        ];
    }
}
