<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengabdians', function (Blueprint $table) {
            // Cegah error kalau migrate dijalankan ulang
            if (!Schema::hasColumn('pengabdians', 'ketua_dosen_id')) {
                $table->unsignedBigInteger('ketua_dosen_id')->nullable();

                $table->foreign('ketua_dosen_id')
                      ->references('id')
                      ->on('dosens')
                      ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengabdians', function (Blueprint $table) {
            if (Schema::hasColumn('pengabdians', 'ketua_dosen_id')) {
                $table->dropForeign(['ketua_dosen_id']);
                $table->dropColumn('ketua_dosen_id');
            }
        });
    }
};
