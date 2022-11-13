<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/login', [LoginController::class, 'login'])->name('login_custom_url');

Route::middleware(['auth:sanctum'])->group(function () {

    //auth
    Route::get('auth/profile', [LoginController::class, 'profile']);
    Route::post('auth/logout', [LoginController::class, 'logout_current']);
    Route::post('auth/logout-current', [LoginController::class, 'logout']);

    //users
    Route::get('users', [UserController::class, 'index']);
});
