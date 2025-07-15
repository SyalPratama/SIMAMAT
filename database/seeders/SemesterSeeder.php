<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('semesters')->insert([
            ['semester_ke' => 1],
            ['semester_ke' => 2],
            ['semester_ke' => 3],
            ['semester_ke' => 4],
        ]);
    }
}
