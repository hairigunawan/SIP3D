<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('dokumentasis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('penelitian_id')->constrained()->onDelete('cascade');
        $table->foreignId('mahasiswa_id')->constrained()->onDelete('cascade');
        $table->enum('jenis', ['foto', 'video']);
        $table->string('file_path')->nullable();
        $table->string('drive_link')->nullable();
        $table->timestamps();
    });
}

};
