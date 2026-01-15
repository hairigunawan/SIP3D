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
            MahasiswaSeeder::class,
            FixedAdminSeeder::class,
            FixedDosenSeeder::class, // ← Dosen sudah ditambahkan
        ]);
    }
}
