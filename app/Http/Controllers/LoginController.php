<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\SaveLogs;
use App\Models\User;
use Exception;

class LoginController extends Controller
{
    protected $savelogs;

    public function __construct(SaveLogs $savelogs)
    {
        $this->savelogs = $savelogs;
    }

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
        try{

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {

                $userDetails = User::where('email', $credentials['email'])->First();

                Session::flash('success', 'Welcome ' . $userDetails->fname . ' ' . $userDetails->mname . ' ' . $userDetails->lname);
                
                $this->savelogs->store("Login Module", $userDetails->fname . ' ' . $userDetails->lname , "Success", "User logging in..."); 

                return redirect()->route('dashboard');
            } else {

                $this->savelogs->store("Login Module", "Unknown User" , "Error", "Invalid credentials"); 

                Session::flash('error', 'Invalid credentials');
                return redirect()->route('login');
            }

        }catch(Exception $e){

            //$this->savelogs->store("Login Module", 'Unknown User' , "Bug", "Exception Error / Exception Bug"); 

            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    public function logout()
    {
        $userAuth = Auth::user();

        try{
            $this->savelogs->store("Logout Module", $userAuth->fname . ' ' . $userAuth->lname , "Sucess", "User logging out..."); 

            Auth::logout();
            return redirect()->route('login');

        }catch(Exception $e){
            $this->savelogs->store("Logout Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 

            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        try
        {

            $data = $request->validate([
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:3|confirmed',
            ]);

            $user = new User();
            $user->fname = ucfirst(strtolower($data['fname']));
            $user->mname = ucfirst(strtolower($request['mname']));
            $user->lname = ucfirst(strtolower($data['lname']));
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            Session::flash('success', 'User registered successfully');
            return redirect()->route('login');
            
        }catch(Exception $e){

        }
    }
}
