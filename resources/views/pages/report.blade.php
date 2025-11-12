@extends('layouts.main')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6 flex items-center gap-2">
        <x-heroicon-o-clipboard-document-list class="w-8 h-8" />
        Laporan Perpustakaan
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card bg-base-200 p-6 rounded-2xl shadow">
            <h2 class="text-xl font-semibold mb-4">Laporan Anggota</h2>
            <p class="text-gray-600 mb-4">Cetak daftar seluruh anggota terdaftar.</p>
            <a href="{{ route('reports.print', 'members') }}" target="_blank" class="btn btn-primary w-full">
                <x-heroicon-o-printer class="w-5 h-5 mr-2" /> Cetak Laporan
            </a>
        </div>

        <div class="card bg-base-200 p-6 rounded-2xl shadow">
            <h2 class="text-xl font-semibold mb-4">Laporan Buku</h2>
            <p class="text-gray-600 mb-4">Cetak data seluruh koleksi buku.</p>
            <a href="{{ route('reports.print', 'books') }}" target="_blank" class="btn btn-primary w-full">
                <x-heroicon-o-printer class="w-5 h-5 mr-2" /> Cetak Laporan
            </a>
        </div>

        <div class="card bg-base-200 p-6 rounded-2xl shadow">
            <h2 class="text-xl font-semibold mb-4">Laporan Peminjaman</h2>
            <p class="text-gray-600 mb-4">Cetak catatan transaksi peminjaman.</p>
            <a href="{{ route('reports.print', 'borrowings') }}" target="_blank" class="btn btn-primary w-full">
                <x-heroicon-o-printer class="w-5 h-5 mr-2" /> Cetak Laporan
            </a>
        </div>
    </div>
</div>
@endsection
