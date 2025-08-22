<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perusahaan_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perusahaan_id'); // hubungkan ke perusahaan
            $table->string('posisi');
            $table->text('deskripsi')->nullable();
            $table->string('lokasi')->nullable();
            $table->integer('gaji')->nullable();
            $table->timestamps();

            $table->foreign('perusahaan_id')
      ->references('id')
      ->on('perusahaans') // <-- pakai plural sesuai tabel
      ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perusahaan_jobs');
    }
};
