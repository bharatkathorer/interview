<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



    Route::get('/users', [\App\Http\Controllers\UserController::class,'index']);
    Route::post('/users', [\App\Http\Controllers\UserController::class,'store']);
    Route::get('/users/{user:id}/edit', [\App\Http\Controllers\UserController::class,'edit']);
    Route::patch('/users/{user:id}/update', [\App\Http\Controllers\UserController::class,'update']);
    Route::delete('/users/{user:id}/delete', [\App\Http\Controllers\UserController::class,'destroy']);
