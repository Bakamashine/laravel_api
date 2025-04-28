<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\WorkShiftController;
use App\Models\WorkShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\ApiHelper;
// use Laravel\Fortify\Http\Controllers\RegisteredUserController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Получение информации о пользователе
Route::get("/users/getinfo", function (Request $request) {
    return auth('sanctum')->user();
})->middleware("auth:sanctum");



Route::get("test", function () {
    return 2;
})->middleware("auth:sanctum");

// Администратор
Route::middleware(['auth:sanctum', 'abilities:1'])
    ->group(function () {
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
    });