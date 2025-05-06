<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WorkShiftController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Получение информации о пользователе
Route::get("/users/getinfo", function (Request $request) {
    return auth('sanctum')->user();
})->middleware("auth:sanctum");


// Администратор
Route::middleware(['auth:sanctum', 'abilities:1'])
    ->group(function () {
        Route::controller(AdminController::class)
            ->group(function () {
                Route::get("/user", 'show');
                Route::get("/user/{user}", 'detail');
                Route::post("/user", 'CreateNewUser');
            });
        Route::controller(WorkShiftController::class)
            ->group(function () {
                Route::post('work-shift', '__invoke');
                Route::patch('work-shift/{id}/open', 'open');
                Route::patch('work-shift/{id}/close', 'close');
                Route::post('work-shift/{id}/user', 'addUser');
                Route::get("work-shift/{id}/order", 'getAllForId');
            });
    });

Route::controller(OrderController::class)
    ->group(function () {

        // Официант
        Route::post("order", '__invoke');

        Route::get("order/taken", 'get_All_With_Good_Status');

        Route::get("order/{order}", 'getForId');
        Route::patch("order/{order}/change-status", 'changeStatus');
        
    });

