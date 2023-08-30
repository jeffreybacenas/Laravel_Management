<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $users = User::where('id', '!=', $user->id)->get();

        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        if($request->userID == null){
            
            $data = $request->validate([
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:3|confirmed',
            ]);
    
            $user = new User();
            $user->name = $data['fname'] . ' ' . $data['lname']; 
            $user->email = $data['email'];
            $user->role_id = 1;
            $user->password = bcrypt($data['password']);
            $user->save();

            Session::flash('success', 'User inserted successfully');

        }else{

            $data = $request->validate([
                'name' => 'required|unique:categories,name,' .$request->catID,
            ]);

            $category = Category::find($request->catID);

            $category->name = $data['name'];
            $category->description = $request->desc;
            $category->save();
            
            Session::flash('success', 'Category updated successfully');

        }
        
        return redirect()->route('user');
    }
}
