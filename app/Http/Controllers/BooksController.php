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
        
    }

}
