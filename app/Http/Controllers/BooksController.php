<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Book;

class BooksController extends Controller
{
    protected $catalogController;

    public function __construct(CatalogController $catalogController)
    {
        $this->catalogController = $catalogController;
    }

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
            $book->description = $request['description'];
            $book->author = $request['author'];
            $book->publishdate = $request['publishDate'];
            $book->save();

            Session::flash('success', 'Book inserted successfully');

            $bookId = Book::max('id');

            $this->catalogController->store($data['title'], $request['description'], $bookId);

        }else{

            $data = $request->validate([
                'title' => 'required|unique:books,title,' .$request->bookID,
            ]);

            $book = Book::find($request['bookID']);

            $book->title = $data['title'];
            $book->description = $request['description'];
            $book->author = $request['author'];
            $book->publishdate = $request['publishDate'];
            $book->save();
            
            Session::flash('success', 'Book updated successfully');

            $this->catalogController->update($data['title'], $request['description'], $request['bookID']);

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
        
        $this->catalogController->delete($id);

        return response()->json(['message' => 'Book deleted successfully'], 200);

    }

}
