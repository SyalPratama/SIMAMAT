<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\SetorTugas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    // DOSEN

    public function index()
    {
        $mataKuliahs = MataKuliah::with(['prodi', 'semester'])
                        ->where('dosen_id', Auth::id())
                        ->orderBy('nama_mk') // urutkan jika perlu
                        ->get();

        return view('dosen.matkul', compact('mataKuliahs'));
    }

    public function byMatakuliah($id)
    {
        $tugas = Tugas::with(['matakuliah', 'matakuliah.prodi', 'matakuliah.semester'])
                      ->where('mata_kuliah_id', $id)
                      ->where('dosen_id', Auth::id())
                      ->get();

        return view('dosen.tugas.tugas', compact('tugas'));
    }

    // Form tambah tugas
    public function create()
    {
        $matakuliahs = MataKuliah::with(['semester', 'prodi'])
            ->where('dosen_id', auth()->id())
            ->get();

        return view('dosen.tugas.create-tugas', compact('matakuliahs'));
    }

    // Simpan tugas baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'tanggal_deadline' => 'required|date',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:5120',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'tanggal_deadline', 'mata_kuliah_id']);
        $data['dosen_id'] = Auth::id();
        $data['tanggal_dibuat'] = now();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('tugas', 'public');
        }

        $tugas = Tugas::create($data);

        return redirect()
            ->route('tugas.byMatakuliah', ['id' => $tugas->mata_kuliah_id])
            ->with('success', 'Tugas berhasil ditambahkan.');
    }

    // Form edit tugas
    public function edit($id)
    {
        $tugas = Tugas::where('id', $id)->where('dosen_id', Auth::id())->firstOrFail();
        $matakuliahs = MataKuliah::with(['prodi', 'semester'])
                        ->where('dosen_id', Auth::id())
                        ->orderBy('nama_mk') // urutkan jika perlu
                        ->get();

        return view('dosen.tugas.edit-tugas', compact('tugas', 'matakuliahs'));
    }

    // Update tugas
    public function update(Request $request, $id)
    {
        $tugas = Tugas::where('id', $id)->where('dosen_id', Auth::id())->firstOrFail();

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'tanggal_deadline' => 'required|date',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:5120',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'tanggal_deadline', 'mata_kuliah_id']);

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($tugas->file && Storage::disk('public')->exists($tugas->file)) {
                Storage::disk('public')->delete($tugas->file);
            }

            $data['file_tugas'] = $request->file('file')->store('tugas', 'public');
        }

        $tugas->update($data);

        return redirect()
            ->route('tugas.byMatakuliah', ['id' => $tugas->mata_kuliah_id])
            ->with('success', 'Tugas berhasil diupdate.');
    }

    // Hapus tugas
    public function destroy($id)
    {
        $tugas = Tugas::where('id', $id)->where('dosen_id', Auth::id())->firstOrFail();

        if ($tugas->file && Storage::disk('public')->exists($tugas->file)) {
            Storage::disk('public')->delete($tugas->file);
        }

        $tugas->delete();

        return redirect()
            ->route('tugas.byMatakuliah', ['id' => $tugas->mata_kuliah_id])
            ->with('success', 'Tugas berhasil dihapus.');
    }

    public function show($id)
    {
        $tugas = Tugas::with(['matakuliah.semester', 'matakuliah.prodi', 'setorTugas.mahasiswa'])
                      ->findOrFail($id);

        return view('dosen.tugas.detail-tugas', compact('tugas'));
    }

    public function updateSetor(Request $request, $id)
    {
        $setor = SetorTugas::findOrFail($id);

        $setor->status = $request->input('status');
        $setor->komentar = $request->input('komentar');
        $setor->nilai = $request->input('nilai');
        $setor->updated_at = now();
        $setor->save();

        return back()->with('success', 'Data berhasil diperbarui.');
    }

    // AKHIR DOSEN
}
