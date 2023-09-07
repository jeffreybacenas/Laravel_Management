<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\SaveLogs;
use App\Models\Dvd;

class DVDController extends Controller
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
            $dvds = Dvd::All();

            $this->savelogs->store("Dvd Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Retrieving dvd list"); 
            
            return view('dvd.index', compact('dvds'));
        }catch(Exception $e){
            $this->savelogs->store("Dvd Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }
    
    public function store(Request $request)
    {
        $userAuth = Auth::user();

        try{

            if($request->dvdId == null){

                $data = $request->validate([
                    'name' => 'required|unique:dvds'
                ]);

                $dvd = new Dvd;
                $dvd->name = $data['name'];
                $dvd->description = $request['dvdDesc'];
                $dvd->save();

                $this->savelogs->store("Dvd Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "DVD inserted successfully"); 
            
                Session::flash('success', 'DVD inserted successfully');
            }else{

                $data = $request->validate([
                    'name' => 'required|unique:dvds,name,'. $request->dvdId,
                ]);

                $dvd = Dvd::find($request['dvdId']);

                $dvd->name = $data['name'];
                $dvd->description = $request['dvdDesc'];
                $dvd->save();

                $this->savelogs->store("Dvd Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "DVD updated successfully"); 
            
                Session::flash('success', 'DVD updated successfully');
                
            }
            
            return redirect()->route('dvd');
        }catch(Exception $e){
            $this->savelogs->store("Dvd Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        $userAuth = Auth::user();

        try{
            $dvd = Dvd::findOrFail($id);

            $this->savelogs->store("Dvd Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Retrieving dvd details"); 
            
            return new JsonResponse($dvd);
        }catch(Exception $e){
            $this->savelogs->store("Dvd Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $userAuth = Auth::user();

        try{

            $dvd = Dvd::find($id);

            if (!$dvd) {
                $this->savelogs->store("Dvd Module", $userAuth->fname . ' ' . $userAuth->lname , "Error", "DVD not found"); 
            
                return response()->json(['message' => 'DVD not found'], 404);
            }

            $dvd->delete();
            Session::flash('success', 'DVD deleted successfully');
            
            $this->savelogs->store("Dvd Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "DVD deleted successfully"); 
            return response()->json(['message' => 'DVD deleted successfully'], 200);

        }catch(Exception $e){

            $this->savelogs->store("Dvd Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }

    }
}
