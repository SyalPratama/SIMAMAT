<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetorTugasTable extends Migration
{
    public function up(): void
    {
        Schema::create('setor_tugas', function (Blueprint $table) {
            $table->id(); // ID utama

            $table->unsignedBigInteger('tugas_id')->nullable()->index();
            $table->unsignedBigInteger('mahasiswa_id')->nullable()->index();

            $table->string('file_path', 255)->nullable();
            $table->text('catatan')->nullable();
            $table->dateTime('tanggal_setor')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->enum('status', ['terkirim', 'diterima', 'terlambat', 'revisi'])->default('terkirim');

            $table->integer('nilai')->nullable();
            $table->text('komentar')->nullable();

            $table->timestamps();

            // Relasi foreign key
            $table->foreign('tugas_id')->references('id')->on('tugas')->onDelete('set null');
            $table->foreign('mahasiswa_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('setor_tugas');
    }
}
