<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view("auth.index");
    }

    public function registration()
    {
        return view("auth.registration");
    }

    public function store(Request $request)
    {
        dd("hi jeff");
        $data = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $data['fname'] . ' ' . $data['lname']; 
        $user->email = $data['email'];
        $user->role = 1;
        $user->password = bcrypt($data['password']);
        $user->save();

        return redirect()->route('dashboard')->with('success', 'User created successfully.');
    }
}
