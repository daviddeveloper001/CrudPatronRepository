<?php

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
});
