<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\WorkShiftController;
use App\Models\WorkShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(UserController::class)
    ->group(function () {

        Route::middleware('guest:sanctum')
            ->group(function () {
                // Route::post("/register", 'register');

                // Route::post("/login", 'login');
            });
    });


Route::get("test", function () {
    return 2;
})->middleware("auth:sanctum");

// Route::post("/logout", [UserController::class, 'logout'])->middleware("auth:sanctum");

// Administrator
Route::controller(AdminController::class)
    ->group(function () {
        Route::get("/user", 'show');
        Route::get("/user/{id}", 'detail');
        Route::post("/user", 'CreateNewUser');
    });
Route::controller(WorkShiftController::class)
    ->group(function () {
        Route::post('work-shift', 'create');
        Route::patch('work-shift/{id}/open', 'open');
        Route::patch('work-shift/{id}/close', 'close');
        Route::post('work-shift/{id}/user', 'addUser');
    });