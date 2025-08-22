<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('jobs', function (Blueprint $table) {
        if (!Schema::hasColumn('jobs', 'gaji_min')) {
            $table->integer('gaji_min')->nullable()->after('deskripsi');
        }
        if (!Schema::hasColumn('jobs', 'gaji_max')) {
            $table->integer('gaji_max')->nullable()->after('gaji_min');
        }
    });
}
};