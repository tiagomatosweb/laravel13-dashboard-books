<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/livros', function() {
    return view('books.index');
})->name('books.index');

Route::get('/livros/{id}', function($id) {
    // return $id;
    return view('books.show');
})->name('books.show');

// meusite.com.br/aempresa
// meusite.com.br/servicos
// meusite.com.br
