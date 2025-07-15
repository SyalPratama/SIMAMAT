<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProdiSeeder::class,
            SemesterSeeder::class,
            UserSeeder::class,
            MatkulSeeder::class,
            TugasSeeder::class,
            SetorTugasSeeder::class,
            PengumumanSeeder::class,
        ]);
    }
}
