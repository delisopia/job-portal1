<?php
// database/migrations/xxxx_add_fields_to_users_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('job_seeker'); // admin, job_seeker
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('cv_path')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'address', 'cv_path']);
        });
    }
};