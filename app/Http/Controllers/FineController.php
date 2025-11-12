<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function index()
    {
        $fines = Fine::latest()->paginate(10);
        return view('pages.fine', compact('fines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:0',
        ]);

        Fine::create($request->only('nominal'));

        return redirect()->route('fines.index')->with('success', 'Denda berhasil ditambahkan.');
    }

    public function update(Request $request, Fine $fine)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:0',
        ]);

        $fine->update($request->only('nominal'));

        return redirect()->route('fines.index')->with('success', 'Denda berhasil diperbarui.');
    }

    public function destroy(Fine $fine)
    {
        $fine->delete();
        return redirect()->route('fines.index')->with('success', 'Denda berhasil dihapus.');
    }
}
