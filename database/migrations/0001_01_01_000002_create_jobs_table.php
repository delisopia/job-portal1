<?php
// database/migrations/xxxx_create_jobs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('posisi'); // nama posisi/jabatan
            $table->string('perusahaan');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->date('tanggal_tutup');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};