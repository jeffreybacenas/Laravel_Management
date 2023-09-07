<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\SaveLogs;
use App\Models\Book;

class BooksController extends Controller
{
    protected $savelogs;

    public function __construct(SaveLogs $savelogs)
    {
        $this->savelogs = $savelogs;
    }

    public function index()
    {
        try{

            $books = Book::All();

            $this->savelogs->store("Book Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Retrieving book list"); 
            
            return view('books.index' ,compact('books'));

        }catch(Exception $e){
            $this->savelogs->store("Book Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        try{

            if($request['bookID'] == null){
                
                $data = $request->validate([
                    'title' => 'required|unique:books'
                ]);

                $book = new Book;
                $book->title = $data['title'];
                $book->description = $request['description'];
                $book->author = $request['author'];
                $book->publishdate = $request['publishDate'];
                $book->save();

                $this->savelogs->store("Book Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Book inserted successfully"); 
            
                Session::flash('success', 'Book inserted successfully');

            }else{

                $data = $request->validate([
                    'title' => 'required|unique:books,title,' .$request['bookID'],
                ]);

                $book = Book::find($request['bookID']);

                $book->title = $data['title'];
                $book->description = $request['description'];
                $book->author = $request['author'];
                $book->publishdate = $request['publishDate'];
                $book->save();
                
                $this->savelogs->store("Book Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Book inserted successfully"); 
            
                Session::flash('success', 'Book updated successfully');

                $this->catalogController->update($data['title'], $request['description'], 'Book' . $request['bookID']);

            }
            
            return redirect()->route('books');

        }catch(Exception $e){
            $this->savelogs->store("Book Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        try{
            $book = Book::findOrFail($id);

            return new JsonResponse($book);
        }catch(Exception $e){
            $this->savelogs->store("Book Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try{

            $book = Book::find($id);

            if (!$book) {
                return response()->json(['message' => 'Book not found'], 404);
            }

            $book->delete();
            Session::flash('success', 'Book deleted successfully');
            
            $this->catalogController->delete($id);

            return response()->json(['message' => 'Book deleted successfully'], 200);

        }catch(Exception $e){

            $this->savelogs->store("Book Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

}
