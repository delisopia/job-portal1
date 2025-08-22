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
    Schema::table('perusahaan_jobs', function (Blueprint $table) {
        $table->date('tanggal_tutup')->nullable(); // nullable jika bisa kosong
    });
}

public function down()
{
    Schema::table('perusahaan_jobs', function (Blueprint $table) {
        $table->dropColumn('tanggal_tutup');
    });
}
};