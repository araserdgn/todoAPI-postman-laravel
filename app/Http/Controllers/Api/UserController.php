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
            'password' => 'required|string|min:6'
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

        return apiResponse(__('Kayıt olusturuldu.'),200,$data);
        // Dillerde çeviri desteği sağlar
    }

    public function login(Request $request) {
        $this->validate($request,[
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ], [
            'email.required' => 'Email alanı boş olamaz.',
            'email.email' => 'Email formatına uygun değil.',
            'password.required'=>'Şifre alanı boş bırakılamaz.',
            'password.min'=>'Şifre alanı minimum 6 karakter olmalıdır.'
        ]);

        if(auth()->attempt(['email'=>$request->email, 'password' => $request->password])) {
            $user = auth()->user();
            $token = $user->createToken('api_case')->accessToken;
            $token_text = $user->createToken('api_case')->plainTextToken;
            return apiResponse(__('Success Login'),200, ['token_text' =>$token_text,'token' =>$token,'user' =>$user]);
        }

        return apiResponse(__('UNAUTHORIZED'),401);
    }
}
