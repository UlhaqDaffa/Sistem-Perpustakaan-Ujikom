<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('id_anggota')->insert([
            [
                'nama' => 'Andi',
                'alamat' => 'Jl. Merdeka No. 1',
                'no_hp' => '081234567890',
                'tgl_lahir' => '2000-01-01',
                'tgl_daftar' => now(),
            ],
            [
                'nama' => 'Budi',
                'alamat' => 'Jl. Kemerdekaan No. 2',
                'no_hp' => '081234567891',
                'tgl_lahir' => '2001-02-02',
                'tgl_daftar' => now(),
            ],
        ]);
    }
}