<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;

Route::middleware('auth')->group(function(){
    Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
});

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');

    Route::post('/login', [AuthController::class, 'handleLogin']);
    Route::post('/register', [AuthController::class, 'handleRegister']);
});