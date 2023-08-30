<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Dvd;

class DVDController extends Controller
{
    public function index()
    {
        $dvds = Dvd::All();

        return view('dvd.index', compact('dvds'));
    }
    
    public function store(Request $request)
    {
        if($request->dvdId == null){

            $data = $request->validate([
                'name' => 'required|unique:dvds'
            ]);

            $dvd = new Dvd;
            $dvd->name = $data['name'];
            $dvd->description = $request->dvdDesc;
            $dvd->save();

            Session::flash('success', 'DVD inserted successfully');

        }else{

            $data = $request->validate([
                'name' => 'required|unique:dvds,'. $request->dvdId,
            ]);

            $dvd = Dvd::find($request->dvdId);

            $dvd->name = $data['name'];
            $dvd->description = $request->dvdDesc;
            $dvd->save();
            
            Session::flash('success', 'DVD updated successfully');


        }
        
        return redirect()->route('dvd');
    }


    public function edit($id)
    {
        $dvd = Dvd::findOrFail($id);

        return new JsonResponse($dvd);
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
