<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('resources.index');
    }
    return view('landing');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Resource Routes
    Route::get('/dashboard', [ResourceController::class, 'index'])->name('resources.index');
    Route::patch('/resources/{resource}/favorite', [ResourceController::class, 'toggleFavorite'])->name('resources.favorite');
    Route::resource('resources', ResourceController::class)->except('index');
});
