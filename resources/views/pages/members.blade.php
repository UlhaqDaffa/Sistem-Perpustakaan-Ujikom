@extends('layouts.main')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Daftar Anggota</h1>
    <button class="btn btn-primary" onclick="document.getElementById('addModal').showModal()">Tambah Anggota</button>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table w-full">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Tanggal Lahir</th>
            <th>Tanggal Daftar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $member->nama }}</td>
            <td>{{ $member->alamat }}</td>
            <td>{{ $member->no_hp }}</td>
            <td>{{ $member->tgl_lahir }}</td>
            <td>{{ $member->tgl_daftar }}</td>
            <td>
                <button class="btn btn-sm btn-warning" onclick="document.getElementById('editModal-{{ $member->id }}').showModal()">Edit</button>
                <form action="{{ route('members.destroy', $member) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-error" onclick="return confirm('Yakin hapus anggota ini?')">Hapus</button>
                </form>
            </td>
        </tr>

        <!-- Modal Edit -->
        <dialog id="editModal-{{ $member->id }}" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg mb-4">Edit Anggota</h3>
                <form action="{{ route('members.update', $member) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="nama" value="{{ $member->nama }}" placeholder="Nama" class="input input-bordered w-full mb-2" required>
                    <input type="text" name="alamat" value="{{ $member->alamat }}" placeholder="Alamat" class="input input-bordered w-full mb-2" required>
                    <input type="text" name="no_hp" value="{{ $member->no_hp }}" placeholder="No HP" class="input input-bordered w-full mb-2" required>
                    <input type="date" name="tgl_lahir" value="{{ $member->tgl_lahir }}" class="input input-bordered w-full mb-2" required>
                    <input type="date" name="tgl_daftar" value="{{ $member->tgl_daftar }}" class="input input-bordered w-full mb-2" required>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <button type="button" class="btn" onclick="document.getElementById('editModal-{{ $member->id }}').close()">Batal</button>
                    </div>
                </form>
            </div>
        </dialog>
        @endforeach
    </tbody>
</table>

{{ $members->links() }}

<!-- Modal Tambah -->
<dialog id="addModal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Tambah Anggota</h3>
        <form action="{{ route('members.store') }}" method="POST">
            @csrf
            <input type="text" name="nama" placeholder="Nama" class="input input-bordered w-full mb-2" required>
            <input type="text" name="alamat" placeholder="Alamat" class="input input-bordered w-full mb-2" required>
            <input type="text" name="no_hp" placeholder="No HP" class="input input-bordered w-full mb-2" required>
            <input type="date" name="tgl_lahir" class="input input-bordered w-full mb-2" required>
            <input type="date" name="tgl_daftar" class="input input-bordered w-full mb-2" required>
            <div class="flex justify-end mt-4">
                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                <button type="button" class="btn" onclick="document.getElementById('addModal').close()">Batal</button>
            </div>
        </form>
    </div>
</dialog>
@endsection
