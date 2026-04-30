<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        // Eager loading
        // Lazy loading
        $books = Book::with('genre')->orderBy('title')->paginate(5);

        return view('books.index', [
            'books' =>  $books,
        ]);
    }

    public function create()
    {
        $genres = Genre::all();
        return view('books.create', [
            'genres' => $genres,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre_id' => 'required|exists:genres,id',
            'published_year' => 'required',
            'description' => 'nullable',
            'cover' => 'image|required',
        ]);

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $validated['cover'] = $request->file('cover')->store();
        }
        
        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Livro adicionado com sucesso!');
    }

    public function show(Book $book)
    {
        $book->loadMissing('genre');

        return view('books.show', [
            'book' => $book,
        ]);
    }

    public function edit(Book $book)
    {
        $genres = Genre::all();
        return view('books.edit', [
            'book' => $book,
            'genres' => $genres,
        ]);
    }

    public function update(Book $book, Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre_id' => 'required|exists:genres,id',
            'published_year' => 'required',
            'description' => 'nullable',
            'cover' => 'image|nullable',
        ]);

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            if ($book->cover) {
                Storage::delete($book->cover);
            }
            $validated['cover'] = $request->file('cover')->store();
        }
        
        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Livro editado com sucesso!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Livro deletado com sucesso!');
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