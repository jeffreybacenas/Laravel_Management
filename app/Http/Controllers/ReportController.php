<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use App\Models\Book;
use App\Models\Magazine;
use App\Models\Dvd;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function getData(Request $request)
    {
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

        }

        // Create a structured data array that includes headers and data rows
        $structuredData = [
            'headers' => $columnHeaders,
            'data' => $data,
        ];

        return response()->json($structuredData);
    }
}
