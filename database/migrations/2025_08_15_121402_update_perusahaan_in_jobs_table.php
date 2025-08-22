<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Bisa pilih salah satu:
            $table->string('perusahaan')->nullable()->change(); // Boleh kosong
            // atau
            // $table->string('perusahaan')->default('Tidak Diketahui')->change();
        });
    }

    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('perusahaan')->nullable(false)->change();
        });
    }
};
