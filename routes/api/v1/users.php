<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::middleware('auth')
    ->prefix('users')
    ->name('users.')
    ->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::patch('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/', [UserController::class, 'destroy'])->name('destroy');
    });