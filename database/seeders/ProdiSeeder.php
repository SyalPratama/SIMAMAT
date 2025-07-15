<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prodis')->insert([
            ['nama_prodi' => 'Teknologi Rekayasa Perangkat Lunak'],
            ['nama_prodi' => 'Teknologi Rekayasa multimedia'],
            ['nama_prodi' => 'Bisnis Digital'],
        ]);
    }
}
