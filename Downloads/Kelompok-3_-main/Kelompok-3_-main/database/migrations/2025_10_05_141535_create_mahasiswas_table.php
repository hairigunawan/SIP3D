<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('mahasiswas', function (Blueprint $table) {
        $table->id();
        $table->string('nim')->unique();
        $table->string('nama');
        $table->string('email')->unique();
        $table->string('fakultas');
        $table->string('prodi');
        $table->year('angkatan');
        $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
};
