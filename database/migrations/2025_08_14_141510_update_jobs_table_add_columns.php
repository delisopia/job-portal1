<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            if (!Schema::hasColumn('jobs', 'gaji_min')) {
                $table->integer('gaji_min')->nullable()->after('deskripsi');
            }
            if (!Schema::hasColumn('jobs', 'gaji_max')) {
                $table->integer('gaji_max')->nullable()->after('gaji_min');
            }
            if (!Schema::hasColumn('jobs', 'tipe_kerja')) {
                $table->string('tipe_kerja', 50)->nullable()->after('gaji_max');
            }
            if (!Schema::hasColumn('jobs', 'pengalaman')) {
                $table->string('pengalaman', 50)->nullable()->after('tipe_kerja');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            if (Schema::hasColumn('jobs', 'gaji_min')) {
                $table->dropColumn('gaji_min');
            }
            if (Schema::hasColumn('jobs', 'gaji_max')) {
                $table->dropColumn('gaji_max');
            }
            if (Schema::hasColumn('jobs', 'tipe_kerja')) {
                $table->dropColumn('tipe_kerja');
            }
            if (Schema::hasColumn('jobs', 'pengalaman')) {
                $table->dropColumn('pengalaman');
            }
        });
    }
};
