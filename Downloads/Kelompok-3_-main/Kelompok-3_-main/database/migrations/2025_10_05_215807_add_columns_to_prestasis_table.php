<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->string('code')->nullable()->after('id')->index();
            $table->string('nama')->nullable()->after('code');

            $table->integer('skor_sinta')->default(0)->after('nama');
            $table->integer('skor_sinta_3yr')->default(0)->after('skor_sinta');
            $table->integer('jumlah_buku')->default(0)->after('skor_sinta_3yr');
            $table->integer('jumlah_hibah')->default(0)->after('jumlah_buku');
            $table->integer('publikasi_scholar')->default(0)->after('jumlah_hibah');
        });
    }

    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->dropColumn([
                'code',
                'nama',
                'skor_sinta',
                'skor_sinta_3yr',
                'jumlah_buku',
                'jumlah_hibah',
                'publikasi_scholar',
            ]);
        });
    }
};
