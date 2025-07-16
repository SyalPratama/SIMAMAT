@extends('layouts.admin.head')

@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Pengumuman')

@section('konten')
<div class="flex-1 overflow-y-auto px-4 py-3 pb-28 w-full max-w-sm mx-auto scroll-mobile">
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.announcement.index') }}" class="text-indigo-600 hover:text-indigo-800 text-lg">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="text-xl font-semibold text-gray-800">
                {{ $isEdit ? 'Edit Pengumuman' : 'Tambah Pengumuman' }}
            </h1>
        </div>
    </div>

    <form action="{{ $isEdit ? route('admin.announcement.update', $announcement->id) : route('admin.announcement.store') }}"
        method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-md p-4 space-y-5">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <!-- Judul -->
        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="judul" id="judul"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm"
                value="{{ old('judul', $announcement->judul ?? '') }}" required>
        </div>

        <!-- Isi -->
        <div>
            <label for="isi" class="block text-sm font-medium text-gray-700">Isi</label>
            <textarea name="isi" id="isi" rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm"
                required>{{ old('isi', $announcement->isi ?? '') }}</textarea>
        </div>

        <!-- Tanggal -->
        <div>
            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm"
                value="{{ old('tanggal', isset($announcement->tanggal) ? \Carbon\Carbon::parse($announcement->tanggal)->format('Y-m-d') : '') }}" required>
        </div>

        <!-- Dibuat Oleh -->
        <div>
            <label for="dibuat_oleh" class="block text-sm font-medium text-gray-700">Dibuat Oleh</label>
            <input type="text" name="dibuat_oleh" id="dibuat_oleh"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm"
                value="{{ old('dibuat_oleh', $announcement->dibuat_oleh ?? auth()->user()->name) }}" required>
        </div>

        <!-- File (opsional) -->
        <div>
            <label for="file_path" class="block text-sm font-medium text-gray-700">File (PDF/Doc, opsional)</label>
            <input type="file" name="file_path" id="file_path"
                class="mt-1 block w-full text-sm text-gray-700">
            @if (!empty($announcement->file_path))
                <a href="{{ asset('storage/' . $announcement->file_path) }}" target="_blank" class="text-xs text-blue-600 hover:underline mt-1 block">
                    Lihat File Saat Ini
                </a>
            @endif
        </div>

        <!-- Target Audience -->
        <div>
            <label for="target_audience" class="block text-sm font-medium text-gray-700">Target</label>
            <select name="target_audience" id="target_audience"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm" required>
                <option value="">Pilih Target</option>
                <option value="mahasiswa" {{ old('target_audience', $announcement->target_audience ?? '') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="dosen" {{ old('target_audience', $announcement->target_audience ?? '') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="semua" {{ old('target_audience', $announcement->target_audience ?? '') == 'semua' ? 'selected' : '' }}>Semua</option>
            </select>
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end pt-2">
            <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700 w-full">
                {{ $isEdit ? 'Perbarui Pengumuman' : 'Tambah Pengumuman' }}
            </button>
        </div>
    </form>
</div>
@endsection
