<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mahasiswas')->insert([
            'username' => 'mahasiswa1',
            'password' => Hash::make('password123'),
            'nama' => 'Mahasiswa Satu',
            'email' => 'mahasiswa1@example.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
