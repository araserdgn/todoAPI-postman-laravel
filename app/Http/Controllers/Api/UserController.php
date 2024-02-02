<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request) {
        $data=$request->all();


        $user = $this->userService->register($data); //! Service ile olan yapı

        // $data = User::create( [ //! controler ile olan yöntem budur
        //     'name' => $requestData['name'],
        //     'email' => $requestData['email'],
        //     'password' => Hash::make($requestData['password']) //şifremizi şifreliyorz
        // ]);

        return apiResponse(__('Kayıt olusturuldu.'),200,['user' => $user]);
        // Dillerde çeviri desteği sağlar
    }

    public function login(LoginRequest $request) {

        $user = $this->userService->login($request->only(['email','password']));

        if(auth()->attempt(['email'=>$request->email, 'password' => $request->password])) {
            $user = auth()->user();
            $token = $user->createToken('api_case')->accessToken;
            $token_text = $user->createToken('api_case')->plainTextToken;
            return apiResponse(__('Success Login'),200, ['token_text' =>$token_text,'token' =>$token,'user' =>$user]);
        }

        return apiResponse(__('UNAUTHORIZED'),401);
    }


    public function logout(Request $request) {
        return Auth::guard('api')->user();
        if(Auth::guard('api')->check()) {
            Auth::guard('api')->user()->token()->revoke();
            return apiResponse(__('Başarıyla çıkıs yaptın'),200,['user' => auth()->user()]);
        }
        else {
            return apiResponse(__('Çıkıs yapıldı',401));
        }

    }

    public function myProfil(Request $request) {
        // return Auth::guard('api')->user();
        return $user = $this->userService->user();
    }

    public function updateUserImage(Request $request) {
        $user = $this->userService->updateUserImage(auth()->user()->id, $request->file('image'));

        if($user) {
            return apiResponse(__('Updated Image'),200, ['user' => new UserResource($user)]);
        }

        return apiResponse(__('Information is ıncorrect',400));
    }


}

