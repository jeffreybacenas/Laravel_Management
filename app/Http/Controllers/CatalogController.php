<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalog;

class CatalogController extends Controller  
{
    public function index()
    {
        $catalogs = Catalog::All();
        return view('catalog.index', compact('catalogs'));
    }
}
