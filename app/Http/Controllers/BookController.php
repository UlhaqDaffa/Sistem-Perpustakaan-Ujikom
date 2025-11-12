<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\bookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = book::with('kategori')->latest()->paginate(10);
        $categories = bookCategory::all();
        return view('pages.books', compact('books', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required|exists:kategori_buku,id',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'isbn' => 'required|numeric',
            'tgl_input' => 'required|date',
            'jml_halaman' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->route('books.index')
                ->withErrors($validator)
                ->withInput();
        }

        Book::create([
            'id_kategori' => $request->id_kategori,
            'id_user' => Auth::id() ?? 1, // fallback kalo belum login system
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'isbn' => $request->isbn,
            'tgl_input' => $request->tgl_input,
            'jml_halaman' => $request->jml_halaman,
        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required|exists:kategori_buku,id',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'isbn' => 'required|numeric',
            'tgl_input' => 'required|date',
            'jml_halaman' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->route('books.index')
                ->withErrors($validator)
                ->with('error_book_id', $book->id);
        }

        $book->update([
            'id_kategori' => $request->id_kategori,
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'isbn' => $request->isbn,
            'tgl_input' => $request->tgl_input,
            'jml_halaman' => $request->jml_halaman,
        ]);

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
