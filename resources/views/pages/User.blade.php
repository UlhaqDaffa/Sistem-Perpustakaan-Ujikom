@extends('layouts.main')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Daftar User</h1>
    <button class="btn btn-primary" onclick="document.getElementById('addModal').showModal()">Tambah User</button>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table w-full">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama User</th>
            <th>Role</th>
            <th>Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->nama_user }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>{{ $user->created_at->format('d M Y') }}</td>
            <td>
                <button class="btn btn-sm btn-warning" onclick="document.getElementById('editModal-{{ $user->id }}').showModal()">Edit</button>
                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-error" onclick="return confirm('Yakin hapus user ini?')">Hapus</button>
                </form>
            </td>
        </tr>

        <!-- Modal Edit -->
        <dialog id="editModal-{{ $user->id }}" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg mb-4">Edit User</h3>
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="nama_user" value="{{ $user->nama_user }}" placeholder="Nama User" class="input input-bordered w-full mb-2" required>
                    <input type="password" name="password" placeholder="Password (kosongkan jika tidak diubah)" class="input input-bordered w-full mb-2">
                    <select name="role" class="select select-bordered w-full mb-2" required>
                        <option value="admin" @selected($user->role === 'admin')>Admin</option>
                        <option value="user" @selected($user->role === 'user')>User</option>
                    </select>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <button type="button" class="btn" onclick="document.getElementById('editModal-{{ $user->id }}').close()">Batal</button>
                    </div>
                </form>
            </div>
        </dialog>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}

<!-- Modal Tambah -->
<dialog id="addModal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Tambah User</h3>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <input type="text" name="nama_user" placeholder="Nama User" class="input input-bordered w-full mb-2" required>
            <input type="password" name="password" placeholder="Password" class="input input-bordered w-full mb-2" required>
            <select name="role" class="select select-bordered w-full mb-2" required>
                <option value="">Pilih Role</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            <div class="flex justify-end mt-4">
                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                <button type="button" class="btn" onclick="document.getElementById('addModal').close()">Batal</button>
            </div>
        </form>
    </div>
</dialog>
@endsection
