<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\SaveLogs;
use App\Models\User;

class UserController extends Controller
{
    protected $savelogs;

    public function __construct(SaveLogs $savelogs)
    {
        $this->savelogs = $savelogs;
    }

    public function index()
    {
        $userAuth = Auth::user();

        try{

            $users = User::where('id', '!=', $userAuth->id)->get();

            $this->savelogs->store("User Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Retrieving user list"); 
            
            return view('user.index', compact('users'));

        }catch(Exception $e){
            
            $this->savelogs->store("User Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 

            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        
        $userAuth = Auth::user();

        try{

            if($request->userID == null){
                
                $data = $request->validate([
                    'fname' => 'required',
                    'lname' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:3|confirmed',
                ]);

                $user = new User();
                $use->fname = ucfirst(strtolower($data['fname2']));
                $user->mname = ucfirst(strtolower($request['mname']));
                $user->lname = ucfirst(strtolower($data['lname']));
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();

                $this->savelogs->store("User Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "User inserted successfully");

                Session::flash('success', 'User inserted successfully');

            } else {

                $data = $request->validate([
                    'fname' => 'required',
                    'lname' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:3|confirmed',
                ]);

                $user = User::find($request->userID);

                $user->fname = ucfirst(strtolower($data['fname']));
                $user->mname = ucfirst(strtolower($request['mname']));
                $user->lname = ucfirst(strtolower($data['lname']));
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();

                $this->savelogs->store("User Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "User updated successfully");

                Session::flash('success', 'User updated successfully');

            }

            return redirect()->route('user');

        }catch(Exception $e)
        {
            $this->savelogs->store("User Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug");

            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $userAuth = Auth::user();

        try{
            $user = User::findOrFail($id);

            $this->savelogs->store("User Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Retrieve user details");

            return new JsonResponse($user);
        }catch(Exception $e)
        {
            $this->savelogs->store("User Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug");

            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        
        $userAuth = Auth::user();

        try{

            $user = User::find($id);

            if (!$user) {
                $this->savelogs->store("User Module", $userAuth->fname . ' ' . $userAuth->lname , "Error", "User not found");

                return response()->json(['message' => 'User not found'], 404);
            }

            $user->delete();

            $this->savelogs->store("User Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "User deleted successfully");

            Session::flash('success', 'User deleted successfully');

            return response()->json(['message' => 'User deleted successfully'], 200);

        }catch(Exception $e){

            $this->savelogs->store("User Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug");

            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();

        }

    }

}
