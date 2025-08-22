<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLowongansTable extends Migration
{
    public function up()
    {
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
            $table->string('posisi');
            $table->string('perusahaan');
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lowongans');
    }
}
