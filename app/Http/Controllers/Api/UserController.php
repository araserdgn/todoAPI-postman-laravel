<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) {
        $requestData=$request->all();

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min6'
        ] ,
        [
            'name.required' => 'Name alanını doldurmak zorundasın.',
            'name.string' => 'Text tipini string yapmalısın',
            'name.max' => 'Max 255 karakterde olmalıdır.',
            'email.required' => 'Email alanını doldurmak zorundasınız.',
            'email.string' => 'Email alanı tip string olmalıdır.',
            'email.unique' => 'Email zaten kayıtlıdır.',
            'email.email' => 'Geçersiz email türü.',
            'password.required' => 'Şifre alanı boş bırakılamaz',
            'password.min'=> 'Şifre en az 6 karakterden olusmalıdır'
        ]);

        $data = User::create( [
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']) //şifremizi şifreliyorz
        ]);

        return apiResponse('Message',200,$data);
    }

    public function login() {
        $data = [
            'test',
            'tss'
        ];

        return apiResponse('Test',200,$data);
    }
}
