<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    public function up(): void
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id(); // id utama
            $table->string('judul', 150)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('file_tugas', 255)->nullable();
            $table->date('tanggal_dibuat')->nullable();
            $table->date('tanggal_deadline')->nullable();

            $table->unsignedBigInteger('dosen_id')->nullable()->index();
            $table->unsignedBigInteger('mata_kuliah_id')->nullable()->index();

            $table->timestamps();

            // Relasi foreign key
            $table->foreign('dosen_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('mata_kuliah_id')->references('id')->on('mata_kuliah')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
}
