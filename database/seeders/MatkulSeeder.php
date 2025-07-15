<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatkulSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mata_kuliah')->insert([
            [
                'kode_mk' => 'IF101',
                'nama_mk' => 'Pemrograman Web',
                'dosen_id' => 2, // ID dosen
                'prodi_id' => 1,
                'semester_id' => 1,
            ],
        ]);
    }
}
