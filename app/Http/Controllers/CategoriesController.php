<?php

namespace App\Http\Controllers;

use Illuminate\Http\request;
use App\Models\BookCategory;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = BookCategory::latest()->paginate(10);
        return view('pages.books_category', compact('categories'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'kategori' => 'required|string|max:255|unique:kategori_buku,kategori',
        ]);

        BookCategory::create($validated);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, BookCategory $category)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:255|unique:kategori_buku,kategori,' . $category->id,
        ]);

        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(BookCategory $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
