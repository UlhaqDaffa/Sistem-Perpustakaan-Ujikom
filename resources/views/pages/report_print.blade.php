<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="p-10">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold">{{ $title }}</h1>
        <p class="text-gray-600">Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
        <hr class="my-4">
    </div>

    @if ($type === 'members')
        <table class="w-full border border-gray-400 border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Alamat</th>
                    <th class="border px-4 py-2">No HP</th>
                    <th class="border px-4 py-2">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $m)
                <tr>
                    <td class="border px-4 py-2">{{ $m->id }}</td>
                    <td class="border px-4 py-2">{{ $m->nama }}</td>
                    <td class="border px-4 py-2">{{ $m->alamat }}</td>
                    <td class="border px-4 py-2">{{ $m->no_hp }}</td>
                    <td class="border px-4 py-2">{{ $m->tgl_daftar }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @elseif ($type === 'books')
        <table class="w-full border border-gray-400 border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">Judul</th>
                    <th class="border px-4 py-2">Pengarang</th>
                    <th class="border px-4 py-2">Penerbit</th>
                    <th class="border px-4 py-2">Tahun</th>
                    <th class="border px-4 py-2">Kategori</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $b)
                <tr>
                    <td class="border px-4 py-2">{{ $b->judul }}</td>
                    <td class="border px-4 py-2">{{ $b->pengarang }}</td>
                    <td class="border px-4 py-2">{{ $b->penerbit }}</td>
                    <td class="border px-4 py-2">{{ $b->tahun }}</td>
                    <td class="border px-4 py-2">{{ $b->book_category->kategori ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @elseif ($type === 'borrowings')
        <table class="w-full border border-gray-400 border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">Tanggal Pinjam</th>
                    <th class="border px-4 py-2">Lama Pinjam</th>
                    <th class="border px-4 py-2">Nominal Denda</th>
                    <th class="border px-4 py-2">Anggota</th>
                    <th class="border px-4 py-2">Petugas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $br)
                <tr>
                    <td class="border px-4 py-2">{{ $br->tgl_pinjam }}</td>
                    <td class="border px-4 py-2">{{ $br->lama_pinjam }}</td>
                    <td class="border px-4 py-2">Rp {{ number_format($br->nominal_denda) }}</td>
                    <td class="border px-4 py-2">{{ $br->member->nama ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $br->user->nama_user ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <script>
        window.print();
    </script>
</body>
</html>
