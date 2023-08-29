<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Magazine;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::All();
        return view('magazines.index', compact('magazines'));
    }
}
