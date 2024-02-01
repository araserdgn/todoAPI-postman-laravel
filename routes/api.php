<?php

use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//! auth:api yaptık
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//! USER KISIMLARI
Route::prefix('auth')->group(function() {
    Route::post('/register',[UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);

    Route::get('/logout',[UserController::class, 'logout']);
});

//! TODO KISIMLARI
Route::prefix('todo')->middleware('auth:api')->group(function() {
    Route::get('/list',[TodoController::class, 'index']);
    Route::post('/store',[TodoController::class, 'store']);
    Route::post('/{id}/edit',[TodoController::class, 'edit']);
    Route::post('/delete/{id}', [TodoController::class , 'delete']);

    Route::post('/{id}/update',[TodoController::class, 'update']); // PUT güncellemelerde kullanılır
}) ;

//! Auth

Route::prefix('auth')->middleware('auth:api')->group(function() {
    Route::get('/myprofile',[UserController::class, 'myProfil']);
});
