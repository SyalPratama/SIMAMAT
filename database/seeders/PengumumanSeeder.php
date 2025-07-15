<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengumuman')->insert([
            [
                'judul' => 'Libur Semester',
                'isi' => 'Libur semester dimulai tanggal 1 Agustus 2025.',
                'tanggal' => now(),
                'dibuat_oleh' => 'Admin Super',
                'file_path' => null,
                'target_audience' => 'mahasiswa',
            ],
        ]);
    }
}
