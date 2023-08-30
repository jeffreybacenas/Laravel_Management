<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::All();
        return view('category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        if($request->catID == null){
            
            $data = $request->validate([
                'name' => 'required|unique:categories'
            ]);

            $category = new Category;
            $category->name = $data['name'];
            $category->description = $request->desc;
            $category->save();

            Session::flash('success', 'Category inserted successfully');

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
        
        return redirect()->route('category');
    }
}
