<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view("login.index");
    }

    public function registration()
    {
        return view("login.registration");
    }
    public function store()
    {
        
    }
}
