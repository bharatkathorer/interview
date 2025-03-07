<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('/user/{user:id}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::put('/user/{user:id}/update', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::delete('/user/{user:id}/delete', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
