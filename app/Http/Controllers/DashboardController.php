<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\SaveLogs;
use App\Models\Magazine;
use App\Models\User;
use App\Models\Book;
use App\Models\Dvd;

class DashboardController extends Controller
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

            $bookCount = Book::count();
            $magazineCount = Magazine::count();
            $dvdCount = Dvd::count();
            $userCount = User::count();

            $this->savelogs->store("Dashboard Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Retrieving data to display in dashboard"); 
            
            return view("dashboard.index", compact('bookCount', 'magazineCount', 'dvdCount', 'userCount'));

        }catch(Exception $e){

            $this->savelogs->store("Dashboard Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 
            
            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }
}
