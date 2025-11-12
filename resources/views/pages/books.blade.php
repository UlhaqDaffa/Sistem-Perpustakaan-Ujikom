@extends('layouts.main')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Buku</h1>
        @auth
        <button class="btn btn-primary" onclick="add_modal.showModal()">Tambah Buku</button>
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

    @auth
    @if ($errors->any())
         <div role="alert" class="alert alert-error mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
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
    @endauth

    {{-- Books Table --}}
    <div class="overflow-x-auto bg-base-100 rounded-lg shadow">
        <table class="table table-zebra">
            <thead class="bg-base-200">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Jumlah Halaman</th>
                    @auth
                    <th>Aksi</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <th>{{ $loop->iteration + $books->firstItem() - 1 }}</th>
                        <td>{{ $book->judul }}</td>
                        <td>
                            <div class="badge badge-neutral">
                                {{ $book->kategori->kategori ?? 'N/A' }}
                            </div>
                        </td>
                        <td>{{ $book->pengarang }}</td>
                        <td>{{ $book->penerbit }}</td>
                        <td>{{ $book->tahun }}</td>
                        <td>{{ $book->jml_halaman }}</td>
                        @auth
                        <td class="flex gap-2">
                            <button class="btn btn-sm btn-warning"
                                onclick="openEditModal({{ json_encode($book) }})">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-error"
                                onclick="openDeleteModal('{{ route('books.destroy', $book->id) }}')">
                                Hapus
                            </button>
                        </td>
                        @endauth
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->check() ? 8 : 7 }}" class="text-center">Tidak ada data buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>

@auth
{{-- Add Modal --}}
<dialog id="add_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Tambah Buku Baru</h3>
        <form method="POST" action="{{ route('books.store') }}" class="py-4 space-y-4">
            @csrf
            <div>
                <label class="label"><span class="label-text">Judul</span></label>
                <input type="text" name="judul" placeholder="Judul Buku" class="input input-bordered w-full" required />
            </div>
            <div>
                <label class="label"><span class="label-text">Kategori</span></label>
                <select name="id_kategori" class="select select-bordered w-full" required>
                    <option disabled selected>Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label"><span class="label-text">Pengarang</span></label>
                <input type="text" name="pengarang" placeholder="Nama Pengarang" class="input input-bordered w-full" required />
            </div>
            <div>
                <label class="label"><span class="label-text">Penerbit</span></label>
                <input type="text" name="penerbit" placeholder="Nama Penerbit" class="input input-bordered w-full" required />
            </div>
            <div>
                <label class="label"><span class="label-text">Tahun Terbit</span></label>
                <input type="number" name="tahun" placeholder="Contoh: 2024" class="input input-bordered w-full" required />
            </div>
            <div>
                <label class="label"><span class="label-text">ISBN</span></label>
                <input type="number" name="isbn" placeholder="Nomor ISBN" class="input input-bordered w-full" required />
            </div>
            <div>
                <label class="label"><span class="label-text">Tanggal Input</span></label>
                <input type="date" name="tgl_input" class="input input-bordered w-full" required />
            </div>
            <div>
                <label class="label"><span class="label-text">Jumlah Halaman</span></label>
                <input type="number" name="jml_halaman" placeholder="Jumlah Halaman" class="input input-bordered w-full" required />
            </div>
            <div class="modal-action">
                <button type="button" class="btn" onclick="add_modal.close()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</dialog>

{{-- Edit Modal --}}
<dialog id="edit_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Edit Data Buku</h3>
        <form id="edit_form" method="POST" action="" class="py-4 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="label"><span class="label-text">Judul</span></label>
                <input type="text" id="edit_judul" name="judul" class="input input-bordered w-full" required />
            </div>
            <div>
                <label class="label"><span class="label-text">Kategori</span></label>
                <select id="edit_id_kategori" name="id_kategori" class="select select-bordered w-full" required>
                    <option disabled>Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label"><span class="label-text">Pengarang</span></label>
                <input type="text" id="edit_pengarang" name="pengarang" class="input input-bordered w-full" required />
            </div>
            <div>
                <label class="label"><span class="label-text">Penerbit</span></label>
                <input type="text" id="edit_penerbit" name="penerbit" class="input input-bordered w-full" required />
            </div>
            <div>
                <label class="label"><span class="label-text">Tahun Terbit</span></label>
                <input type="number" id="edit_tahun" name="tahun" class="input input-bordered w-full" required />
            </div>
            <div>
                <label class="label"><span class="label-text">ISBN</span></label>
                <input type="number" id="edit_isbn" name="isbn" class="input input-bordered w-full" required />
            </div>
            <div>
                <label class="label"><span class="label-text">Tanggal Input</span></label>
                <input type="date" id="edit_tgl_input" name="tgl_input" class="input input-bordered w-full" required />
            </div>
            <div>
                <label class="label"><span class="label-text">Jumlah Halaman</span></label>
                <input type="number" id="edit_jml_halaman" name="jml_halaman" class="input input-bordered w-full" required />
            </div>
            <div class="modal-action">
                <button type="button" class="btn" onclick="edit_modal.close()">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</dialog>

{{-- Delete Modal --}}
<dialog id="delete_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
        <p class="py-4">Apakah Anda yakin ingin menghapus buku ini?</p>
        <div class="modal-action">
            <form id="delete_form" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-error">Hapus</button>
            </form>
            <button class="btn" onclick="delete_modal.close()">Batal</button>
        </div>
    </div>
</dialog>
@endauth
@endsection

@push('scripts')
@auth
<script>
    function openEditModal(book) {
        document.getElementById('edit_form').action = '/books/' + book.id;
        document.getElementById('edit_judul').value = book.judul;
        document.getElementById('edit_id_kategori').value = book.id_kategori;
        document.getElementById('edit_pengarang').value = book.pengarang;
        document.getElementById('edit_penerbit').value = book.penerbit;
        document.getElementById('edit_tahun').value = book.tahun;
        document.getElementById('edit_isbn').value = book.isbn;
        document.getElementById('edit_tgl_input').value = book.tgl_input;
        document.getElementById('edit_jml_halaman').value = book.jml_halaman;
        edit_modal.showModal();
    }

    function openDeleteModal(actionUrl) {
        document.getElementById('delete_form').action = actionUrl;
        delete_modal.showModal();
    }
</script>
@endauth
@endpush
