<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Magazine;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::All();
        return view('magazines.index', compact('magazines'));
    }

    public function store(Request $request)
    {
         if($request->magazineId == null){

            $data = $request->validate([
                'name' => 'required|unique:magazines'
            ]);

            $magazine = new Magazine;
            $magazine->name = $data['name'];
            $magazine->description = $request->magazineDesc;
            $magazine->save();

            Session::flash('success', 'Magazine inserted successfully');

        }else{
            
            $data = $request->validate([
                'name' => 'required|unique:magazines,name,' . $request->magazineId,
            ]);

            $magazine = Magazine::find($request->magazineId);

            $magazine->name = $data['name'];
            $magazine->description = $request->magazineDesc;
            $magazine->save();
            
            Session::flash('success', 'Magazine updated successfully');

        }
        
        return redirect()->route('magazines');
    }


    public function edit($id)
    {
        $magazine = Magazine::findOrFail($id);

        return new JsonResponse($magazine);
    }

    public function delete($id)
    {
        $magazine = Magazine::find($id);

        if (!$magazine) {
            return response()->json(['message' => 'Magazine not found'], 404);
        }

        $magazine->delete();
        Session::flash('success', 'Magazine deleted successfully');
        return response()->json(['message' => 'Magazine deleted successfully'], 200);

    }
}
