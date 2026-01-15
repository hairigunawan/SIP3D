<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class FixedDosenSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'dosen@gmail.com'], // email dosen

            [
                'name'     => 'Dosen',
                'password' => Hash::make('dosen123'), // password: dosen123
                // kalau tabel users TIDAK punya kolom "role", hapus baris di bawah ini
                'role'     => 'dosen',
            ]
        );
    }
}
