<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Systemlog;

class SystemLogsController extends Controller
{
    public function index()
    {
        $systemlogs = Systemlog::All();

        return view('systemlogs.index', compact('systemlogs'));
    }

}
