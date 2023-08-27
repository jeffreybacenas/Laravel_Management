<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Magazine;
use App\Models\Dvd;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $magazineCount = Magazine::count();
        $dvdCount = Dvd::count();
        $userCount = User::count();

        return view("dashboard.index", compact('bookCount', 'magazineCount', 'dvdCount', 'userCount'));
    }
}
