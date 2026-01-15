<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penelitians', function (Blueprint $table) {
            // ubah kolom dosen_id menjadi boleh null
            $table->unsignedBigInteger('dosen_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('penelitians', function (Blueprint $table) {
            // kembalikan lagi jadi tidak boleh null (opsional)
            $table->unsignedBigInteger('dosen_id')->nullable(false)->change();
        });
    }
};
