<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Dvd;
class DVDController extends Controller
{
    public function index()
    {
        $dvds = Dvd::All();

        return view('dvd.index', compact('dvds'));
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

            Session::flash('success', 'Book inserted successfully');

        }else{

            $data = $request->validate([
                'title' => 'required|unique:books,title,' .$request->bookID,
            ]);

            $book = Book::find($request->bookID);

            $book->title = $data['title'];
            $book->description = $request->description;
            $book->author = $request->author;
            $book->publishdate = $request->publishDate;
            $book->save();
            
            Session::flash('success', 'Book updated successfully');


        }
        
        return redirect()->route('books');
    }


    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return new JsonResponse($book);
    }

    public function delete($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();
        Session::flash('success', 'Book deleted successfully');
        return response()->json(['message' => 'Book deleted successfully'], 200);

    }
}
