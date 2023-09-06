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
        $user = Auth::user();

        $users = User::where('id', '!=', $user->id)->get();

        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        try{

            $userAuth = Auth::user();

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
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        Session::flash('success', 'User deleted successfully');
        return response()->json(['message' => 'User deleted successfully'], 200);

    }
}
