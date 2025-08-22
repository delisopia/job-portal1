<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('perusahaan_job_id')->nullable()->after('perusahaan_id');
            $table->foreign('perusahaan_job_id')
                  ->references('id')
                  ->on('perusahaan_jobs')
                  ->onDelete('cascade'); // kalau perusahaan_job dihapus, job ikut terhapus
        });
    }

    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign(['perusahaan_job_id']);
            $table->dropColumn('perusahaan_job_id');
        });
    }
};
