@extends('layouts.main')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Denda</h1>
        <button class="btn btn-primary" onclick="addModal.showModal()">+ Tambah Denda</button>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr class="bg-base-200">
                    <th>#</th>
                    <th>Nominal (Rp)</th>
                    <th>Dibuat</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fines as $fine)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ number_format($fine->nominal, 0, ',', '.') }}</td>
                        <td>
                            {{ $fine->created_at ? $fine->created_at->format('d M Y') : '-' }}
                        </td>
                        <td class="flex gap-2 justify-center">
                            <!-- Edit -->
                            <button class="btn btn-sm btn-warning"
                                onclick="editFine({{ $fine->id }}, '{{ $fine->nominal }}')">
                                Edit
                            </button>

                            <!-- Hapus -->
                            <form action="{{ route('fines.destroy', $fine->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus denda ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-error text-white">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Belum ada data denda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $fines->links() }}
    </div>
</div>

<!-- Modal Tambah -->
<dialog id="addModal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Tambah Denda</h3>
        <form action="{{ route('fines.store') }}" method="POST">
            @csrf
            <div class="form-control mb-4">
                <label class="label">Nominal Denda (Rp)</label>
                <input type="number" name="nominal" class="input input-bordered" required min="0" />
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn" onclick="addModal.close()">Batal</button>
            </div>
        </form>
    </div>
</dialog>

<!-- Modal Edit -->
<dialog id="editModal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Edit Denda</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-control mb-4">
                <label class="label">Nominal Denda (Rp)</label>
                <input type="number" id="edit_nominal" name="nominal" class="input input-bordered" required min="0" />
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-warning">Update</button>
                <button type="button" class="btn" onclick="editModal.close()">Batal</button>
            </div>
        </form>
    </div>
</dialog>

@push('scripts')
<script>
function editFine(id, nominal) {
    const form = document.getElementById('editForm');
    form.action = `/fines/${id}`;
    document.getElementById('edit_nominal').value = nominal;
    editModal.showModal();
}
</script>
@endpush
@endsection
