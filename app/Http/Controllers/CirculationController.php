<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CirculationController extends Controller
{
    public function index()
    {
        return view('circulation.index');        
    }
}
