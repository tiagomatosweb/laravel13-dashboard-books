<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Eager loading
        // Lazy loading
        $books = Book::with('genre')->paginate(5);

        return view('books.index', [
            'books' =>  $books,
        ]);
    }

    public function show(Book $book)
    {
        $book->loadMissing('genre');
        return view('books.show', [
            'book' => $book,
        ]);
    }
}

/*


|-------------------------------books---------------------------------|
| id | title                  | author              | genre_id | year |
|----|------------------------|---------------------|----------|------|
| 01 | Dom Casmurro           | Machado de Assis    | 01       | 1899 |
| 02 | Capitães da Areia      | Jorge Amado         | 02       | 1937 |
| 03 | Vidas Secas            | Graciliano Ramos    | 01       | 1938 |
| 04 | O Alquimista           | Paulo Coelho        | 03       | 1988 |
| 05 | Torto Arado            | Itamar Vieira Jr.   | 01       | 2019 |
|---------------------------------------------------------------------|

|--------------------------genres---------------------------|
| id | name      | description                              |
|----|-----------|------------------------------------------|
| 01 | Romance   | Narrativas literárias                    |
| 02 | Ficção    | Ficção geral e clássicos                 |
| 03 | Fantasia  | Fantasia e realismo mágico               |
|-----------------------------------------------------------|

*/