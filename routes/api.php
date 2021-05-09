<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\Auth\RegisterController;
use \App\Http\Controllers\Api\Auth\LoginController;
use \App\Http\Controllers\Api\IntegrationController;

Route::post('register', [RegisterController::class, 'register'])->name('api.register');
Route::post('login', [LoginController::class, 'login'])->name('api.login');
Route::post('/refresh', [LoginController::class, 'refresh']);

Route::middleware('auth:api')->group(function ()
{
    Route::post('logout', [LoginController::class, 'logout']);
    Route::apiResource('integration', IntegrationController::class);

});
