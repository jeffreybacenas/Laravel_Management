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
        $booksCount = Book::count();
        $magazineCount = Magazine::count();
        $dvdCount = Dvd::count();
        $userCount = User::count();

        return view("dashboard.index", compact('booksCount', 'magazineCount', 'dvdCount', 'userCount'));
    }
}
