<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\member;
use App\Models\borrowing;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages.report');
    }

    public function print($type)
    {
        switch ($type) {
            case 'members':
                $data = member::all();
                $title = 'Laporan Data Anggota';
                break;
            case 'books':
                $data = book::with('book_category')->get();
                $title = 'Laporan Data Buku';
                break;
            case 'borrowings':
                $data = borrowing::with(['member', 'fine', 'user'])->get();
                $title = 'Laporan Transaksi Peminjaman';
                break;
            default:
                abort(404);
        }

        return view('pages.report_print', compact('data', 'title', 'type'));
    }
}
