<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_buku')->insert([
            [
                'kategori' => 'Fiksi',
            ],
            [
                'kategori' => 'Non-Fiksi',
            ],
            [
                'kategori' => 'Sains',
            ],
            [
                'kategori' => 'Sejarah',
            ],
        ]);
    }
}