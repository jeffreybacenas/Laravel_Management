<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\SaveLogs;
use App\Models\Magazine;

class MagazineController extends Controller
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
            
            $magazines = Magazine::All();

            $this->savelogs->store("Magazine Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Retrieving magazine list"); 
            
            return view('magazines.index', compact('magazines'));

        }catch(Exception $e){

            $this->savelogs->store("Magazine Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $userAuth = Auth::user();

        try{
            if($request->magazineId == null){

                $data = $request->validate([
                    'name' => 'required|unique:magazines'
                ]);

                $magazine = new Magazine;
                $magazine->name = $data['name'];
                $magazine->description = $request['magazineDesc'];
                $magazine->save();
                
                $this->savelogs->store("Magazine Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Magazine inserted successfully");

                Session::flash('success', 'Magazine inserted successfully');


            }else{
                
                $data = $request->validate([
                    'name' => 'required|unique:magazines,name,' . $request->magazineId,
                ]);

                $magazine = Magazine::find($request['magazineId']);

                $magazine->name = $data['name'];
                $magazine->description = $request['magazineDesc'];
                $magazine->save();

                $this->savelogs->store("Magazine Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Magazine updated successfully");

                Session::flash('success', 'Magazine updated successfully');
            }
            
            return redirect()->route('magazines');
        }catch(Exception $e){

            $this->savelogs->store("Magazine Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        $userAuth = Auth::user();

        try{
            $magazine = Magazine::findOrFail($id);

            $this->savelogs->store("Magazine Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Retrieving magazine details");

            return new JsonResponse($magazine);
        }catch(Exception $e){

            $this->savelogs->store("Magazine Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $userAuth = Auth::user();

        try{

            $magazine = Magazine::find($id);

            if (!$magazine) {

                $this->savelogs->store("Magazine Module", $userAuth->fname . ' ' . $userAuth->lname , "Error", "Magazine not found");

                return response()->json(['message' => 'Magazine not found'], 404);
            }

            $magazine->delete();

            $this->savelogs->store("Magazine Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Magazine deleted successfully");

            Session::flash('success', 'Magazine deleted successfully');

            return response()->json(['message' => 'Magazine deleted successfully'], 200);

        }catch(Exception $e){
            $this->savelogs->store("Magazine Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }
}
