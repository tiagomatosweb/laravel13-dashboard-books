<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $books = Book::all();

    return view('index', [
        'books' => $books
    ]);
})->name('index');

Route::get('/livros', function() {
    $books = Book::all();

    return view('books.index', [
        'books' =>  $books,
    ]);
})->name('books.index');

Route::get('/livros/{id}', function($id) {
    $book = Book::findOrFail($id);

    return view('books.show', [
        'book' => $book,
    ]);
})->name('books.show');

// meusite.com.br/aempresa
// meusite.com.br/servicos
// meusite.com.br
