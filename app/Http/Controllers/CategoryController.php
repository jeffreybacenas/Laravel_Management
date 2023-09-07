<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\SaveLogs;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $savelogs;

    public function __construct(SaveLogs $savelogs)
    {
        $this->savelogs = $savelogs;
    }

    public function index()
    {
        $userAuth = Auth::user();

        try{
            $categories = Category::All();

            $this->savelogs->store("Category Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Retrieving category list"); 
            
            return view('category.index', compact('categories'));
        }catch(Exception $e){

            $this->savelogs->store("Category Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
        
    }

    public function store(Request $request)
    {
        $userAuth = Auth::user();

        try{

            if($request->catID == null){
                
                $data = $request->validate([
                    'name' => 'required|unique:categories'
                ]);

                $category = new Category;
                $category->name = $data['name'];
                $category->description = $request->desc;
                $category->save();

                $this->savelogs->store("Category Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Category inserted successfully"); 
            
                Session::flash('success', 'Category inserted successfully');

            }else{

                $data = $request->validate([
                    'name' => 'required|unique:categories,name,' .$request->catID,
                ]);

                $category = Category::find($request->catID);

                $category->name = $data['name'];
                $category->description = $request->desc;
                $category->save();

                $this->savelogs->store("Category Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Category updated successfully"); 
            
                Session::flash('success', 'Category updated successfully');

            }
            
            return redirect()->route('category');
        }catch(Exception $e){
            $this->savelogs->store("Category Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $userAuth = Auth::user();

        try{

            $category = Category::find($id);    
            
            $this->savelogs->store("Category Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Retrieving category details"); 
            
            return new JsonResponse($category);

        }catch(Exception $e){

            $this->savelogs->store("Category Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();

        }
    }

    public function delete($id)
    {
        $userAuth = Auth::user();

        try{

            $category = Category::find($id);

            if(!$category)
            { 
                $this->savelogs->store("Category Module", $userAuth->fname . ' ' . $userAuth->lname , "Error", "Category not found"); 
            
                return response()->json(['message' => 'Category not found', 404]);
            }

            $category->delete();
            Session::flash('success', 'Category deleted successfully');
            $this->savelogs->store("Category Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Category deleted successfully"); 
            
            return response()->json(['message' => 'Category deleted successfully'], 200);
            
        }catch(Exception $e){
            $this->savelogs->store("Category Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }
}
