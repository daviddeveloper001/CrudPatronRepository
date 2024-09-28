<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('users', App\Http\Controllers\UserController::class)->only('index', 'store');

Route::resource('cars', App\Http\Controllers\CarController::class)->only('index', 'store');

Route::resource('tickets', App\Http\Controllers\TicketController::class)->only('index', 'store');


Route::resource('users', App\Http\Controllers\UserController::class)->only('index', 'store');

Route::resource('cars', App\Http\Controllers\CarController::class)->only('index', 'store');

Route::resource('tickets', App\Http\Controllers\TicketController::class)->only('index', 'store');


Route::resource('users', App\Http\Controllers\UserController::class)->only('index', 'show', 'store');

Route::resource('cars', App\Http\Controllers\CarController::class)->only('index', 'show', 'store');

Route::resource('tickets', App\Http\Controllers\TicketController::class)->only('index', 'show', 'store');
