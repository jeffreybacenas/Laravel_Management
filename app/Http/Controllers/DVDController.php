<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DVDController extends Controller
{
    public function index()
    {
        return view('dvd.index');
    }
}
