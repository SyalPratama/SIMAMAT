<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TugasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tugas')->insert([
            [
                'judul' => 'Tugas 1 Laravel',
                'deskripsi' => 'Buat form CRUD dengan Laravel',
                'file_tugas' => 'tugas/laravel_crud.pdf',
                'tanggal_dibuat' => now(),
                'tanggal_deadline' => now()->addDays(7),
                'dosen_id' => 2,
                'mata_kuliah_id' => 1,
            ],
        ]);
    }
}
