<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



    Route::get('/users', [\App\Http\Controllers\Api\UserController::class,'index']);
    Route::post('/users', [\App\Http\Controllers\Api\UserController::class,'store']);
    Route::get('/users/{user:id}', [\App\Http\Controllers\Api\UserController::class,'edit']);
    Route::put('/users/{user:id}', [\App\Http\Controllers\Api\UserController::class,'update']);
    Route::delete('/users/{user:id}/delete', [\App\Http\Controllers\Api\UserController::class,'destroy']);
