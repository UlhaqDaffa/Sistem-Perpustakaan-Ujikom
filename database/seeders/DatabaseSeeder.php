<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AnggotaSeeder::class,
            DendaSeeder::class,
            KategoriBukuSeeder::class,
            userSeeder::class,
            BukuSeeder::class,
            PeminjamanSeeder::class,
            DetailPinjamSeeder::class,
        ]);
    }
}