<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataKuliahTable extends Migration
{
    public function up(): void
    {
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id(); // ID utama
            $table->string('kode_mk', 20)->nullable();
            $table->string('nama_mk', 100)->nullable();

            $table->unsignedBigInteger('dosen_id')->nullable()->index();
            $table->unsignedBigInteger('prodi_id')->nullable()->index();
            $table->unsignedBigInteger('semester_id')->nullable()->index();

            $table->timestamps();

            // Relasi opsional (pastikan tabel terkait sudah ada)
            $table->foreign('dosen_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('prodi_id')->references('id')->on('prodis')->onDelete('set null');
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
}
