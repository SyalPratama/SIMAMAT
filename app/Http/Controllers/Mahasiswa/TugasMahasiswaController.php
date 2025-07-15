<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\SetorTugas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasMahasiswaController extends Controller
{
    public function indexMahasiswa()
    {
        $mahasiswa = Auth::user();

        if ($mahasiswa->role !== 'mahasiswa') {
            abort(403, 'Akses ditolak.');
        }

        $semesterId = $mahasiswa->semester_id;
        $prodiId = $mahasiswa->prodi_id;

        $tugas = Tugas::with([
            'mataKuliah.prodi',
            'mataKuliah.semester',
            'setorTugas' => function ($q) use ($mahasiswa) {
                $q->where('mahasiswa_id', $mahasiswa->id);
            },
        ])
            ->whereHas('mataKuliah', function ($query) use ($semesterId, $prodiId) {
                $query->where('semester_id', $semesterId)
                      ->where('prodi_id', $prodiId);
            })
            ->get()
            ->sortBy([
                ['mataKuliah.semester.semester_ke', 'asc'],
                ['mataKuliah.nama_mk', 'asc'],
            ])
            ->values();

        return view('mahasiswa.tugas', compact('tugas'));
    }

    public function kerjakan($id)
    {
        $tugas = Tugas::with('mataKuliah')->findOrFail($id);

        return view('mahasiswa.tugas.kerjakan', compact('tugas'));
    }

    public function storeJawaban(Request $request, $id)
    {
        $request->validate([
            'file_jawaban' => 'required|file|mimes:pdf,doc,docx,zip|max:5120',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $tugas = Tugas::findOrFail($id);

        $filePath = $request->file('file_jawaban')->store('jawaban', 'public');

        SetorTugas::create([
            'tugas_id' => $tugas->id,
            'mahasiswa_id' => Auth::id(),
            'file_jawaban' => $filePath,
            'catatan' => $request->input('catatan'),
            'status' => 'terkirim',
            'nilai' => null,
            'created_at' => now(),
        ]);

        return redirect()->route('mahasiswa.tugas.index')->with('success', 'Jawaban berhasil dikirim.');
    }
}
