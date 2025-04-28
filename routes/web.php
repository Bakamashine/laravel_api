<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;


Route::middleware('guest')
    ->group(function () {
        Route::post("/register", [RegisterController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    });