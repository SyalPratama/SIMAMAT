<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function dosen()
    {
        // Ambil 20 pengumuman terakhir untuk ditampilkan
        $pengumuman = Pengumuman::whereIn('target_audience', ['dosen', 'semua'])
            ->orderByDesc('tanggal')
            ->paginate(10);

        return view('dosen.pengumuman', compact('pengumuman'));
    }
}
