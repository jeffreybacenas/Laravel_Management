<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\SaveLogs;
use App\Models\SystemLog;
use App\Models\Magazine;
use App\Models\Book;
use App\Models\Dvd;
use App\Models\User;
use Exception;

class ReportController extends Controller
{
    protected $savelogs;

    public function __construct(SaveLogs $savelogs)
    {
        $this->savelogs = $savelogs;
    }
    public function index()
    {
        return view('report.index');
    }

    public function getData(Request $request)
    {
        $userAuth = Auth::user();

        try{
            $selectedSource = $request->input('source'); // Get the selected data source from the request

            // Define column headers based on the selected source
            $columnHeaders = [];
            if ($selectedSource === 'books') {

                $columnHeaders = [
                    'title' => 'Title', 
                    'description' => 'Description',
                    'author' => 'Author',
                    'publishdate' => 'Publish Date',
                    'created_at' => 'Date Created',
                    'updated_at' => 'Date Updated',
                ];

                $data = Book::select([
                    'title',
                    'description',
                    'author',
                    Book::raw('DATE_FORMAT(publishdate, "%Y-%m-%d") as formatted_publishdate'),
                    Book::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as formatted_created_at'),
                    Book::raw('DATE_FORMAT(updated_at, "%Y-%m-%d") as formatted_updated_at'),
                ])->get();
                

            } else if ($selectedSource === 'magazines') {

                $columnHeaders = [
                    'id ' => 'ID', 
                    'name' => 'Name',
                    'description' => 'Description',
                    'created_at' => 'Date Created',
                    'updated_at' => 'Date Updated',
                ];

                $data = Magazine::select([
                    'id',
                    'name',
                    'description',
                    Magazine::raw('DATE_FORMAT(created_at, "%Y-%m-%d") formatted_created_at'),
                    Magazine::raw('DATE_FORMAT(updated_at, "%Y-%m-%d") formatted_updated_at'),
                ])->get();

            } else if($selectedSource === 'dvds'){
                
                $columnHeaders = [
                    'id' => 'ID', 
                    'name' => 'Name',
                    'description' => 'Description',
                    'created_at' => 'Date Created',
                    'updated_at' => 'Date Updated',
                ];

                $data = Dvd::select([
                    'id',
                    'name',
                    'description',
                    Dvd::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as formatted_created_at'),
                    Dvd::raw('DATE_FORMAT(updated_at, "%Y-%m-%d") as formatted_updated_at'),
                ])->get();

            }else if($selectedSource === 'users'){

                $columnHeaders = [
                    'id' => 'ID', 
                    'full_name' => 'Name', // Update 'name' to 'full_name' to match the concatenated column
                    'email' => 'Email',
                    'formatted_created_at' => 'Date Created', // Update to match the formatted date column
                    'formatted_updated_at' => 'Date Updated', // Update to match the formatted date column
                ];
                
                $data = User::select([
                    'id',
                    User::raw('CONCAT(fname, " ", mname, " ", lname) as full_name'),
                    'email',
                    User::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as formatted_created_at'),
                    User::raw('DATE_FORMAT(updated_at, "%Y-%m-%d") as formatted_updated_at'),
                ])->get();

            }else if($selectedSource === 'systemLogs'){

                $columnHeaders = [
                    'modulename' => 'Module Name', 
                    'actionname' => 'Action Name', 
                    'status' => 'Status',
                    'remarks' => 'Remarks', 
                    'formatted_created_at' => 'Date Created',
                    'formatted_updated_at' => 'Date Updated',
                ];
                
                $data = SystemLog::select([
                    'modulename',
                    'actionname',
                    'status',
                    'remarks',
                    User::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as formatted_created_at'),
                    User::raw('DATE_FORMAT(updated_at, "%Y-%m-%d") as formatted_updated_at'),
                ])->get();

            }else{
                $columnHeaders = null;
                $data = null;
            }
            
            $structuredData = [
                'headers' => $columnHeaders,
                'data' => $data,
            ];

            $this->savelogs->store("Report Module", $userAuth->fname . ' ' . $userAuth->lname , "Success", "Retrieving selected module for reporting"); 

            return response()->json($structuredData);

        }catch(Exception $e){
            $this->savelogs->store("Report Module", $userAuth->fname . ' ' . $userAuth->lname , "Bug", "Exception Error / Exception Bug"); 

            Session::flash('error', 'Oops! Something went wrong. Please try again later.');
            return redirect()->back();
        }
    }
}
