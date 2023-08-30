<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
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
                'name' => 'required|unique:categories,name,' .$request->catID,
            ]);

            $category = Category::find($request->catID);

            $category->name = $data['name'];
            $category->description = $request->desc;
            $category->save();
            
            Session::flash('success', 'Category updated successfully');

        }
        
        return redirect()->route('category');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return new JsonResponse($category);
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if(!$category)
        {
            return response()->json(['message' => 'Category not found', 404]);
        }

        $category->delete();
        Session::flash('success', 'Category deleted successfully');
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
