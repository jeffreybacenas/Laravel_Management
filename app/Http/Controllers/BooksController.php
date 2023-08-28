<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::All();
        return view('books.index' ,compact('books'));
    }

    public function store(Request $request)
    {
        if($request->bookID == null){
            $data = $request->validate([
                'title' => 'required|unique:books'
            ]);

            $book = new Book;
            $book->title = $data['title'];
            $book->description = $request->description;
            $book->author = $request->author;
            $book->publishdate = $request->publishDate;
            $book->save();

        }else{

            $data = $request->validate([
                'title' => 'required|unique:books'
            ]);

            $book = Book::find($request->bookID);

            $book->title = $dat['title'];
            $book->description = $request->description;
            $book->author = $request->author;
            $book->publishdate = $request->publishDate;
            $book->save();

        }
        
        return redirect()->route('books');
    }


    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return new JsonResponse($book);
    }

}
