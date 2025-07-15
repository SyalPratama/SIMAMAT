<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Super',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'role' => 'superadmin',
                'status' => 'active',
                'nim' => null,
                'nidn' => null,
                'nip' => '19876543210',
                'prodi_id' => 1,
                'semester_id' => null,
            ],
            [
                'name' => 'Agus Julian',
                'email' => 'agus@poltekmi.ac.id',
                'password' => Hash::make('agus123'),
                'role' => 'dosen',
                'status' => 'active',
                'nim' => null,
                'nidn' => '1234567890',
                'nip' => null,
                'prodi_id' => 1,
                'semester_id' => null,
            ],
            [
                'name' => 'Sarah V',
                'email' => 'sarah@poltekmi.ac.id',
                'password' => Hash::make('sarah123'),
                'role' => 'dosen',
                'status' => 'active',
                'nim' => null,
                'nidn' => '1234567889',
                'nip' => null,
                'prodi_id' => 1,
                'semester_id' => null,
            ],
            [
                'name' => 'Muhammad Faisyal',
                'email' => 'faisyalnur@poltekmi.ac.id',
                'password' => Hash::make('syalpra123'),
                'role' => 'mahasiswa',
                'status' => 'active',
                'nim' => '2301010058',
                'nidn' => null,
                'nip' => null,
                'prodi_id' => 1,
                'semester_id' => 1,
            ],
        ]);
    }
}
