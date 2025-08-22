<?php
// database/migrations/xxxx_create_applications_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('applications', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('job_id');
        $table->string('nama');
        $table->string('email');
        $table->string('telepon');
        $table->text('alamat');
        $table->string('cv');
        $table->timestamps();

        $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
    });
}

    public function down()
    {
        Schema::dropIfExists('applications');
    }
};