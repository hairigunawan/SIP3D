<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('dosens', function (Blueprint $table) {
        $table->id();
        $table->string('nidn')->unique();
        $table->string('nama');
        $table->string('email')->unique();
        $table->string('fakultas');
        $table->string('prodi');
        $table->string('jabatan');
        $table->year('tahun');
        $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
        $table->timestamps();
    });
}

};
