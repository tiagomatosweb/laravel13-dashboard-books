<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/livros', [BookController::class, 'index'])->name('books.index');
Route::get('/livros/{book}', [BookController::class, 'show'])->name('books.show');
