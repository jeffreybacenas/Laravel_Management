<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemLogsController extends Controller
{
    public function index()
    {
        return view('systemlogs.index');
    }
}
