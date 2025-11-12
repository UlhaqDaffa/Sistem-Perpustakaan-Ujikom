<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPinjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_pinjam')->insert([
            [
                'id_pinjam' => 1,
                'tgl_kembali' => now()->addDays(7),
            ],
        ]);
    }
}