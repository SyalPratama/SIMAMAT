<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\Prodi;
use App\Models\Semester;
use App\Models\User;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Hitung jumlah berdasarkan role
        $jumlahMahasiswa = User::where('role', 'mahasiswa')->count();
        $jumlahDosen = User::where('role', 'dosen')->count();
        $jumlahStaf = User::where('role', 'superadmin')->count();

        // Mahasiswa per semester (gunakan 'semester_ke')
        $mahasiswaPerSemester = Semester::withCount(['users' => function ($query) {
            $query->where('role', 'mahasiswa');
        }])->pluck('users_count', 'semester_ke');

        // Mahasiswa per prodi (gunakan 'nama_prodi')
        $mahasiswaPerProdi = Prodi::withCount(['users' => function ($query) {
            $query->where('role', 'mahasiswa');
        }])->pluck('users_count', 'nama_prodi');

        // Ambil 5 pengumuman terbaru
        $pengumuman = Pengumuman::latest()->take(5)->get();

        // Kirim ke view
        return view('admin.index', compact(
            'jumlahMahasiswa',
            'jumlahDosen',
            'jumlahStaf',
            'mahasiswaPerSemester',
            'mahasiswaPerProdi',
            'pengumuman'
        ));
    }
}
