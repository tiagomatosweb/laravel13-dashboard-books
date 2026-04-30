<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/livros', [BookController::class, 'index'])->name('books.index');
Route::get('/livros/criar', [BookController::class, 'create'])->name('books.create');
Route::post('/livros/criar', [BookController::class, 'store'])->name('books.store');
Route::get('/livros/{book}', [BookController::class, 'show'])->name('books.show');
Route::put('/livros/{book}', [BookController::class, 'update'])->name('books.update');
Route::delete('/livros/{book}', [BookController::class, 'destroy'])->name('books.destroy');
Route::get('/livros/{book}/editar', [BookController::class, 'edit'])->name('books.edit');
