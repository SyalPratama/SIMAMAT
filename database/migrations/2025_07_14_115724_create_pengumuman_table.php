<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePengumumanTable extends Migration
{
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id(); // id utama

            $table->string('judul', 255);
            $table->text('isi');
            $table->dateTime('tanggal')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('dibuat_oleh', 100);
            $table->string('file_path', 255)->nullable();

            $table->enum('target_audience', ['dosen', 'mahasiswa', 'semua']);

            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
}
