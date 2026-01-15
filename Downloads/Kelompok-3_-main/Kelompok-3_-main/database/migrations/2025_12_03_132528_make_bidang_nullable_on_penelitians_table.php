<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penelitians', function (Blueprint $table) {
            // ubah kolom bidang jadi boleh NULL
            $table->string('bidang', 255)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('penelitians', function (Blueprint $table) {
            // kalau mau kembalikan seperti semula (tidak boleh null)
            $table->string('bidang', 255)->nullable(false)->change();
        });
    }
};
