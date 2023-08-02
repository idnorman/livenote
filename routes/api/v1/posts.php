<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::middleware('auth')
    ->prefix('posts')
    ->name('posts.')
    ->group(function(){
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/{post}', [PostController::class, 'show'])->name('show');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::patch('/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/', [PostController::class, 'destroy'])->name('destroy');
    });