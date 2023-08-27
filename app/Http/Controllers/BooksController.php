<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::All();
        return view('books.index' ,compact('books'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:books'
        ]);

        $book = new Book;
        $book->title = $data['title'];
        $book->description = $request->description;
        $book->author = $request->author;
        $book->publishdate = $request->publishDate;
        $book->save();
        
        return redirect()->route('books');
    }

}
