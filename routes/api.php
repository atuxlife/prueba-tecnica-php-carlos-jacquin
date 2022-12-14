<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('list-users', [UserController::class, 'index']);
    Route::get('show-user/{id}', [UserController::class, 'show']);
    Route::post('create-user', [UserController::class, 'create']);
    Route::put('update-user/{id}', [UserController::class, 'updateUser']);
    Route::get('logout', [UserController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
