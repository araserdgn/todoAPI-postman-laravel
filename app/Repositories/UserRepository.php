<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class UserRepository {
        protected $model;

        public function __construct(User $model) {
            $this->model = $model;
        }

        public function register($data) {
            try {
                return $this->model->create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password'])
                ]);
            } catch (QueryException $e) {
                if($e->errorInfo[1] == 1062) {
                    return response()->json(['error' => 'The email is already in use.'],401);
                }
                throw $e;
            }
        }

        public function login($data) {
            if(auth()->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return auth()->user();
            }
        }

        public function find($userId) {

        }

        public function user() {

        }

        public function updateUserImage($userId, $image) {

        }
}
