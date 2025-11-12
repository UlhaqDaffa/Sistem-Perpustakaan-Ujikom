@extends('layouts.main')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div class="stats shadow">
            <div class="stat">
                <div class="stat-title">Total Buku</div>
                <div class="stat-value">{{ $bookCount }}</div>
            </div>
        </div>
        <div class="stats shadow">
            <div class="stat">
                <div class="stat-title">Total Anggota</div>
                <div class="stat-value">{{ $memberCount }}</div>
            </div>
        </div>
        <div class="stats shadow">
            <div class="stat">
                <div class="stat-title">Total Peminjaman</div>
                <div class="stat-value">{{ $borrowingCount }}</div>
            </div>
        </div>
    </div>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">Peminjaman Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>ID Pinjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Lama Pinjam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentBorrowings as $borrowing)
                        <tr>
                            <th>{{ $borrowing->id }}</th>
                            <td>{{ $borrowing->tgl_pinjam }}</td>
                            <td>{{ $borrowing->lama_pinjam }} hari</td>
                            <td>
                                @if ($borrowing->borrowing_detail->isEmpty())
                                    <span class="badge badge-warning">Dipinjam</span>
                                @else
                                    <span class="badge badge-success">Dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data peminjaman.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
