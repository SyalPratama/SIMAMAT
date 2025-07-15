<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;

class DashboardMahasiswaController extends Controller
{
    public function index()
    {
        // Ambil 5 pengumuman terbaru untuk mahasiswa dan semua
        $pengumuman = Pengumuman::whereIn('target_audience', ['mahasiswa', 'semua'])
            ->orderByDesc('tanggal')
            ->limit(5)
            ->get();

        return view('mahasiswa.index', compact('pengumuman'));
    }
}
