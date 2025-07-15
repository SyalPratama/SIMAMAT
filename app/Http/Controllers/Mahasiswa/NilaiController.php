<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\SetorTugas;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'mahasiswa') {
            abort(403, 'Akses ditolak.');
        }

        // Ambil data nilai dengan relasi tugas dan mahasiswa
        $nilai = SetorTugas::with('tugas.matakuliah', 'mahasiswa')
            ->where('mahasiswa_id', $user->id)
            ->get()
            ->groupBy(fn ($item) => $item->tugas->matakuliah->nama_mk ?? 'Tidak Diketahui');

        return view('mahasiswa.nilai', compact('nilai'));
    }
}
