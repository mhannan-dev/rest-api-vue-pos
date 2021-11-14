<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->name('me');
    //Route::resource('/users', AuthController::class);
});

