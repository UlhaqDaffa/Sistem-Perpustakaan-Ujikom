<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buku')->insert([
            [
                'judul' => 'Buku Fiksi 1',
                'pengarang' => 'Pengarang Fiksi 1',
                'penerbit' => 'Penerbit Fiksi 1',
                'tahun' => 2021,
                'isbn' => 1234567890,
                'tgl_input' => now(),
                'jml_halaman' => 100,
                'id_kategori' => 1,
                'id_user' => 1,
            ],
            [
                'judul' => 'Buku Non-Fiksi 1',
                'pengarang' => 'Pengarang Non-Fiksi 1',
                'penerbit' => 'Penerbit Non-Fiksi 1',
                'tahun' => 2022,
                'isbn' => 1234567891,
                'tgl_input' => now(),
                'jml_halaman' => 150,
                'id_kategori' => 2,
                'id_user' => 1,
            ],
        ]);
    }
}