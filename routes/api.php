<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {

    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('api.users.index');
        Route::get('/{user}', [UserController::class, 'show'])->name('api.users.show');
        Route::post('/', [UserController::class, 'store'])->name('api.users.store');
        Route::patch('/{user}', [UserController::class, 'update'])->name('api.users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('api.users.destroy');
        Route::get('/same-first-and-last-name/{name}', [UserController::class, 'getWithSameFirstAndLastName'])->name('api.users.getWithSameFirstAndLastName');
    });


    Route::prefix('/cars')->group(function () {
        Route::get('/', [CarController::class, 'index'])->name('api.cars.index');
        Route::get('/{car}', [CarController::class, 'show'])->name('api.cars.show');
        Route::post('/', [CarController::class, 'store'])->name('api.cars.store');
        Route::patch('/{car}', [CarController::class, 'update'])->name('api.cars.update');
        Route::delete('/{car}', [CarController::class, 'destroy'])->name('api.cars.destroy');
    });

    Route::prefix('/tickets')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('api.tickets.index');
        Route::get('/{ticket}', [TicketController::class, 'show'])->name('api.tickets.show');
        Route::post('/', [TicketController::class, 'store'])->name('api.tickets.store');
        Route::patch('/{ticket}', [TicketController::class, 'update'])->name('api.tickets.update');
        Route::delete('/{ticket}', [TicketController::class, 'destroy'])->name('api.tickets.destroy');
    });
});

