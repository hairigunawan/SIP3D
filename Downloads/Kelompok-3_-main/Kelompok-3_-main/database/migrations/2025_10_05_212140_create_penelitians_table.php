<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penelitians', function (Blueprint $table) {
            $table->id();

            // RELASI UTAMA
            $table->unsignedBigInteger('dosen_id')->nullable();
            $table->unsignedBigInteger('mahasiswa_id')->nullable();

            // DATA PENELITIAN
            $table->string('judul');
            $table->string('bidang');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();

            // KOLOM INTI (DIPINDAH KE CREATE)
            $table->integer('tahun')->nullable();

            $table->enum('status', ['Aktif', 'Selesai', 'Dibatalkan'])->default('Aktif');

            $table->timestamps();

            // OPTIONAL FOREIGN KEY (AKTIFKAN NANTI KALAU PERLU)
            /*
            $table->foreign('dosen_id')
                  ->references('id')
                  ->on('dosens')
                  ->onDelete('set null');

            $table->foreign('mahasiswa_id')
                  ->references('id')
                  ->on('mahasiswas')
                  ->onDelete('set null');
            */
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penelitians');
    }
};
