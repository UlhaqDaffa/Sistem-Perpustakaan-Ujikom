<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\member;
use App\Models\borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = book::count();
        $memberCount = member::count();
        $borrowingCount = borrowing::count();

        $recentBorrowings = borrowing::with('borrowing_detail', 'fine')->latest()->take(5)->get();

        return view('pages.dashboard', compact('bookCount', 'memberCount', 'borrowingCount', 'recentBorrowings'));
    }
}