<?php

use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ResourceController::class, 'index'])->name('home');

Route::patch('resources/{resource}/favorite', [ResourceController::class, 'toggleFavorite'])->name('resources.favorite');
Route::resource('resources', ResourceController::class);
