<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penelitians', function (Blueprint $table) {
            // Ubah status jadi string (varchar) maksimal 50 karakter dan boleh null
            $table->string('status', 50)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('penelitians', function (Blueprint $table) {
            // Kalau mau kembalikan ke bentuk semula (misal tinyInteger), sesuaikan sendiri.
            // Contoh (kalau dulu tinyInteger):
            // $table->tinyInteger('status')->nullable()->change();
        });
    }
};
