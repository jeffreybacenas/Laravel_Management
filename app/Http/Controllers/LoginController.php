<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

    public function performLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard'); // Change the redirection URL
        } else {
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
        ]);

        $user = new User();
        $user->name = $data['fname'] . ' ' . $data['lname']; 
        $user->email = $data['email'];
        $user->role_id = 1;
        $user->password = bcrypt($data['password']);
        $user->save();
        
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard'); // Change the redirection URL
        }

        return redirect()->route('dashboard')->with('success', 'User created successfully.');
    }
}
