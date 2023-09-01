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
            $dvd->description = $request['dvdDesc'];
            $dvd->save();

            Session::flash('success', 'DVD inserted successfully');

            $dvdId = Dvd::max('id');

            $this->catalogController->store($data['name'], $request['dvdDesc'], $dvdId);

        }else{

            $data = $request->validate([
                'name' => 'required|unique:dvds,name,'. $request->dvdId,
            ]);

            $dvd = Dvd::find($request['dvdId']);

            $dvd->name = $data['name'];
            $dvd->description = $request['dvdDesc'];
            $dvd->save();
            
            Session::flash('success', 'DVD updated successfully');
            
            $this->catalogController->update($data['name'], $request['dvdDesc'], $request['dvdId']);

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
        $dvd = Dvd::find($id);

        if (!$dvd) {
            return response()->json(['message' => 'DVD not found'], 404);
        }

        $dvd->delete();
        Session::flash('success', 'DVD deleted successfully');
        return response()->json(['message' => 'DVD deleted successfully'], 200);

    }
}
