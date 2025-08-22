<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->foreign('perusahaan_job_id')
                  ->references('id')
                  ->on('perusahaan_jobs')
                  ->onDelete('cascade');
        });
        
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedInteger('perusahaan_job_id')->nullable()->change();
        });
        
    }
};
