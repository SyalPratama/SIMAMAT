<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\SetorTugas;

class DashboardDosenController extends Controller
{
    public function index()
    {
        // Ambil peringkat nilai tertinggi berdasarkan tugas dan prodi
        $peringkat = SetorTugas::select(
            'setor_tugas.nilai',
            'users.name as mahasiswa',
            'tugas.judul as tugas',
            'prodis.nama_prodi'
        )
            ->join('users', 'users.id', '=', 'setor_tugas.mahasiswa_id')
            ->join('tugas', 'tugas.id', '=', 'setor_tugas.tugas_id')
            ->join('prodis', 'prodis.id', '=', 'users.prodi_id')
            ->whereNotNull('setor_tugas.nilai')
            ->orderByDesc('setor_tugas.nilai')
            ->limit(10)
            ->get();

        // Ambil 5 pengumuman terbaru untuk dosen dan semua
        $pengumuman = Pengumuman::whereIn('target_audience', ['dosen', 'semua'])
            ->orderByDesc('tanggal')
            ->limit(5)
            ->get();

        return view('dosen.index', compact('peringkat', 'pengumuman'));
    }
}
