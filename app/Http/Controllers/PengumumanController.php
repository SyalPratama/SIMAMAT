<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $announcements = Pengumuman::orderByDesc('tanggal')->paginate(10);

        return view('admin.pengumuman', compact('announcements'));
    }

    public function create()
    {
        $isEdit = false;
        $announcement = null;

        return view('admin.pengumuman.form', compact('isEdit', 'announcement'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'dibuat_oleh' => 'required|string',
            'target_audience' => 'required|in:mahasiswa,dosen,semua',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('pengumuman', 'public');
        }

        Pengumuman::create($data);

        return redirect()->route('admin.announcement.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $announcement = Pengumuman::findOrFail($id);
        $isEdit = true;

        return view('admin.pengumuman.form', compact('isEdit', 'announcement'));
    }

    public function update(Request $request, $id)
    {
        $announcement = Pengumuman::findOrFail($id);

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'dibuat_oleh' => 'required|string',
            'target_audience' => 'required|in:mahasiswa,dosen,semua',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('pengumuman', 'public');
        }

        $announcement->update($data);

        return redirect()->route('admin.announcement.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $announcement = Pengumuman::findOrFail($id);
        $announcement->delete();

        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function dosen()
    {
        // Ambil 20 pengumuman terakhir untuk ditampilkan
        $pengumuman = Pengumuman::whereIn('target_audience', ['dosen', 'semua'])
            ->orderByDesc('tanggal')
            ->paginate(10);

        return view('dosen.pengumuman', compact('pengumuman'));
    }
}
