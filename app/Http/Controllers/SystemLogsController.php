<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Systemlog;

class SystemLogsController extends Controller
{
    public function index()
    {
        try{

            $systemlogs = Systemlog::All();

            $this->savelogs->store("System Logs Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Retrieving system log list"); 
            
            return view('systemlogs.index', compact('systemlogs'));

        }catch(Exception $e){

            $this->savelogs->store("System Logs Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 

            return redirect()->back();

        }
    }

}
