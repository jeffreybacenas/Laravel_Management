<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalog;
use Exception;

class CatalogController extends Controller  
{
    public function index()
    {
        $catalogs = Catalog::All();
        return view('catalog.index', compact('catalogs'));
    }

    public function store($catalogVal, $description, $resourceId)
    {
        $catalog = new Catalog;

        $catalog->catalog = $catalogVal;
        $catalog->description = $description;
        $catalog->resource_id = $resourceId;
        $catalog->save();
    }

    public function update($catalogVal, $description, $resourceId)
    {
        $catalog = Catalog::where('resource_id', $resourceId)->first();

        $catalog->catalog = $catalogVal;
        $catalog->description = $description;
        $catalog->save();
    }

    public function delete($id)
    {
        $catalog = Catalog::where('resource_id', $id)->first();
        $catalog->delete();
    }

}
