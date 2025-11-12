@extends('layouts.main')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Kategori Buku</h1>
        @auth
        <button class="btn btn-primary" onclick="add_modal.showModal()">Tambah Kategori</button>
        @endauth
    </div>

    {{-- Session Messages --}}
    @if (session('success'))
    <div role="alert" class="alert alert-success mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if ($errors->any())
    <div role="alert" class="alert alert-error mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
            viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>
            <strong>Gagal!</strong> Terjadi beberapa kesalahan:
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </span>
    </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto bg-base-100 rounded-lg shadow">
        <table class="table table-zebra">
            <thead class="bg-base-200">
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    @auth
                    <th>Aksi</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration + $categories->firstItem() - 1 }}</td>
                    <td>{{ $category->kategori }}</td>
                    @auth
                    <td class="flex gap-2">
                        <button class="btn btn-sm btn-warning"
                            onclick="openEditModal({{ json_encode($category) }})">
                            Edit
                        </button>
                        <button class="btn btn-sm btn-error"
                            onclick="openDeleteModal('{{ route('categories.destroy', $category->id) }}')">
                            Hapus
                        </button>
                    </td>
                    @endauth
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->check() ? 3 : 2 }}" class="text-center">Belum ada kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $categories->links() }}</div>
</div>

{{-- Add Modal --}}
<dialog id="add_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Tambah Kategori Baru</h3>
        <form method="POST" action="{{ route('categories.store') }}" class="py-4 space-y-4">
            @csrf
            <div>
                <label class="label"><span class="label-text">Nama Kategori</span></label>
                <input type="text" name="kategori" class="input input-bordered w-full" required value="{{ old('kategori') }}" />
            </div>
            <div class="modal-action">
                <button type="button" class="btn" onclick="add_modal.close()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>

{{-- Edit Modal --}}
<dialog id="edit_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Edit Kategori</h3>
        <form id="edit_form" method="POST" action="" class="py-4 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="label"><span class="label-text">Nama Kategori</span></label>
                <input type="text" id="edit_kategori" name="kategori" class="input input-bordered w-full" required />
            </div>
            <div class="modal-action">
                <button type="button" class="btn" onclick="edit_modal.close()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>

{{-- Delete Modal --}}
<dialog id="delete_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
        <p class="py-4">Apakah Anda yakin ingin menghapus kategori ini?</p>
        <div class="modal-action">
            <form id="delete_form" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-error">Hapus</button>
            </form>
            <button class="btn" onclick="delete_modal.close()">Batal</button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop"><button>close</button></form>
</dialog>
@endsection

@push('scripts')
<script>
    function openEditModal(category) {
        document.getElementById('edit_form').action = '/categories/' + category.id;
        document.getElementById('edit_kategori').value = category.kategori;
        edit_modal.showModal();
    }

    function openDeleteModal(actionUrl) {
        document.getElementById('delete_form').action = actionUrl;
        delete_modal.showModal();
    }

    @if ($errors->any())
    document.addEventListener('DOMContentLoaded', function () {
        add_modal.showModal();
    });
    @endif
</script>
@endpush
