<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Add this route for the root URL
Route::get('/', function () {
    return view('welcome');
});

Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::get('/book/create', [BookController::class, 'create'])->name('book.create');