@extends('layouts.main')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Data Peminjaman Buku</h1>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-error mb-4">{{ session('error') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Anggota</th>
                    <th>User</th>
                    <th>Denda</th>
                    <th>Tanggal Pinjam</th>
                    <th>Lama Pinjam (hari)</th>
                    <th>Nominal Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrows as $borrow)
                <tr>
                    <td>{{ $borrow->id }}</td>
                    <td>{{ $borrow->member->nama ?? '-' }}</td>
                    <td>{{ $borrow->user->nama_user ?? '-' }}</td>
                    <td>{{ $borrow->fine->nominal ?? '-' }}</td>
                    <td>{{ $borrow->tgl_pinjam }}</td>
                    <td>{{ $borrow->lama_pinjam }}</td>
                    <td>Rp {{ number_format($borrow->nominal_denda, 0, ',', '.') }}</td>
                    <td class="flex gap-2">
                        <!-- Tombol Edit -->
                        <button onclick="document.getElementById('editBorrow{{ $borrow->id }}').showModal()" class="btn btn-sm btn-warning">Edit</button>

                        <!-- Modal Edit -->
                        <dialog id="editBorrow{{ $borrow->id }}" class="modal">
                            <div class="modal-box">
                                <h3 class="font-bold text-lg mb-4">Edit Data Peminjaman</h3>
                                <form action="{{ route('borrows.update', $borrow->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-control mb-3">
                                        <label class="label">Tanggal Pinjam</label>
                                        <input type="date" name="tgl_pinjam" value="{{ $borrow->tgl_pinjam }}" class="input input-bordered w-full">
                                    </div>
                                    <div class="form-control mb-3">
                                        <label class="label">Lama Pinjam (hari)</label>
                                        <input type="number" name="lama_pinjam" value="{{ $borrow->lama_pinjam }}" class="input input-bordered w-full">
                                    </div>
                                    <div class="form-control mb-3">
                                        <label class="label">Nominal Denda</label>
                                        <input type="number" name="nominal_denda" value="{{ $borrow->nominal_denda }}" class="input input-bordered w-full">
                                    </div>
                                    <div class="form-control mb-3">
                                        <label class="label">Anggota</label>
                                        <select name="id_anggota" class="select select-bordered w-full">
                                            @foreach ($members as $member)
                                                <option value="{{ $member->id }}" {{ $borrow->id_anggota == $member->id ? 'selected' : '' }}>
                                                    {{ $member->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-control mb-3">
                                        <label class="label">Denda</label>
                                        <select name="id_denda" class="select select-bordered w-full">
                                            @foreach ($fines as $fine)
                                                <option value="{{ $fine->id }}" {{ $borrow->id_denda == $fine->id ? 'selected' : '' }}>
                                                    {{ $fine->nominal }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-control mb-3">
                                        <label class="label">User</label>
                                        <select name="id_user" class="select select-bordered w-full">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ $borrow->id_user == $user->id ? 'selected' : '' }}>
                                                    {{ $user->nama_user }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex justify-end gap-2">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn" onclick="document.getElementById('editBorrow{{ $borrow->id }}').close()">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </dialog>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('borrows.destroy', $borrow->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $borrows->links() }}
    </div>
</div>
@endsection
