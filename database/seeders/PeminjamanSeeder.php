<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('peminjaman')->insert([
            [
                'tgl_pinjam' => now(),
                'lama_pinjam' => '7',
                'nominal_denda' => 5000,
                'id_anggota' => 1,
                'id_denda' => 1,
                'id_user' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}