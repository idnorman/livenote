<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;


Route::prefix('comments')
    ->name('comments.')
    ->group(function(){
        Route::get('/', [CommentController::class, 'index'])->name('index');
        Route::get('/{comment}', [CommentController::class, 'show'])->name('show');
        Route::post('/', [CommentController::class, 'store'])->name('store');
        Route::patch('/{comment}', [CommentController::class, 'update'])->name('update');
        Route::delete('/', [CommentController::class, 'destroy'])->name('destroy');
    });