@extends('layouts.mahasiswa.head')

@section('title', 'Kerjakan Tugas')

@section('konten')

<!-- Loader -->
<div id="loader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
    <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-indigo-600 border-opacity-50"></div>
</div>

<div class="flex-1 overflow-y-auto px-4 py-3 pb-28 w-full max-w-sm mx-auto scroll-mobile">

    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center gap-2">
            <a href="javascript:history.back()" class="text-indigo-600 hover:text-indigo-800 text-lg">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="text-xl font-semibold text-gray-800">Kerjakan Tugas</h1>
        </div>
    </div>

    <form action="{{ route('mahasiswa.tugas.storeJawaban', $tugas->id) }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-xl shadow-md p-4 space-y-5">
        @csrf

        <!-- Judul Tugas -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Judul Tugas</label>
            <p class="mt-1 text-sm text-gray-900 font-semibold">{{ $tugas->judul }}</p>
        </div>

        <!-- Deskripsi -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <p class="mt-1 text-sm text-gray-800">{{ $tugas->deskripsi }}</p>
        </div>

        <!-- Mata Kuliah -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
            <p class="mt-1 text-sm text-gray-800">{{ $tugas->mataKuliah->nama_mk ?? '-' }}</p>
        </div>

        <!-- Deadline -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Deadline</label>
            <p class="mt-1 text-sm text-gray-800">{{ \Carbon\Carbon::parse($tugas->deadline)->translatedFormat('d F Y') }}</p>
        </div>

        <!-- Download File jika ada -->
        @if ($tugas->file)
            <div>
                <label class="block text-sm font-medium text-gray-700">File Tugas</label>
                <a href="{{ asset('storage/' . $tugas->file) }}" target="_blank"
                   class="inline-block mt-1 px-3 py-1 text-xs font-medium text-white bg-green-600 rounded hover:bg-green-700">
                    Download File
                </a>
            </div>
        @endif

        <!-- Catatan -->
        <div>
            <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan (opsional)</label>
            <textarea name="catatan" id="catatan" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                      placeholder="Tambahkan catatan jika perlu..."></textarea>
        </div>

        <!-- Upload Jawaban -->
        <div>
            <label for="file_jawaban" class="block text-sm font-medium text-gray-700">Upload Jawaban Anda</label>
            <input type="file" name="file_jawaban" id="file_jawaban"
                   class="mt-1 block w-full text-sm text-gray-700" required>
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end pt-2">
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700 w-full">
                Kirim Jawaban
            </button>
        </div>
    </form>
</div>
@endsection
