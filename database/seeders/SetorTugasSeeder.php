<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetorTugasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('setor_tugas')->insert([
            [
                'tugas_id' => 1,
                'mahasiswa_id' => 4,
                'file_path' => 'uploads/tugas_mahasiswa_b.pdf',
                'catatan' => 'Sudah selesai Pak.',
                'tanggal_setor' => now(),
                'status' => 'terkirim',
                'nilai' => null,
                'komentar' => null,
            ],
        ]);
    }
}
