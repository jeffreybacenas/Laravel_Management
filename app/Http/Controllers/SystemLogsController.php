<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\SaveLogs;
use App\Models\Systemlog;
use Exception;

class SystemLogsController extends Controller
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

            $systemlogs = Systemlog::All();

            $this->savelogs->store("System Logs Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Retrieving system log list"); 
            
            return view('systemlogs.index', compact('systemlogs'));

        }catch(Exception $e){

            $this->savelogs->store("System Logs Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 

            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();

        }
    }

}
