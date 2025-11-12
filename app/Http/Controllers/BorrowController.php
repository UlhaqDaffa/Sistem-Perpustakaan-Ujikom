<?php

namespace App\Http\Controllers;

use App\Models\borrowing;
use App\Models\member;
use App\Models\fine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = borrowing::with(['member', 'fine', 'user'])->latest()->paginate(10);
        $members = member::all();
        $fines = fine::all();
        $users = User::all();

        return view('pages.borrow', compact('borrows', 'members', 'fines', 'users'));
    }

    public function update(Request $request, borrowing $borrow)
    {
        $validator = Validator::make($request->all(), [
            'tgl_pinjam' => 'required|date',
            'lama_pinjam' => 'required|integer|min:1',
            'nominal_denda' => 'required|integer|min:0',
            'id_anggota' => 'required|exists:id_anggota,id',
            'id_denda' => 'required|exists:denda,id',
            'id_user' => 'required|exists:user,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('borrows.index')->withErrors($validator)->with('error_borrow_id', $borrow->id);
        }

        $borrow->update($request->all());
        return redirect()->route('borrows.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(borrowing $borrow)
    {
        $borrow->delete();
        return redirect()->route('borrows.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
