@extends('layouts.admin.head')

@section('title', 'Dashboard Admin')

@section('konten')

<!-- Loader -->
<div id="loader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
    <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-indigo-600 border-opacity-50"></div>
</div>

<!-- Main Content -->
<div class="flex-1 overflow-y-auto px-4 pb-20 py-3 w-full max-w-sm mx-auto scroll-mobile">
    <h1 class="text-xl font-semibold text-gray-800 mb-4">
        Selamat datang, {{ auth()->user()->name }}
    </h1>
    <!-- Mahasiswa per Semester -->
    <div class="bg-white p-4 rounded-xl shadow mb-4">
        <h3 class="text-lg font-semibold text-indigo-600 mb-2">Mahasiswa per Semester</h3>
        <ul class="space-y-1 text-sm text-gray-800">
            @forelse($mahasiswaPerSemester as $semester => $jumlah)
                <li>Semester {{ $semester }}: <span class="font-bold">{{ $jumlah }}</span> mahasiswa</li>
            @empty
                <li class="text-gray-500">Belum ada data semester.</li>
            @endforelse
        </ul>
    </div>

    <!-- Mahasiswa per Prodi -->
    <div class="bg-white p-4 rounded-xl shadow mb-4">
        <h3 class="text-lg font-semibold text-indigo-600 mb-2">Mahasiswa per Program Studi</h3>
        <ul class="space-y-1 text-sm text-gray-800">
            @forelse($mahasiswaPerProdi as $prodi => $jumlah)
                <li>{{ $prodi }}: <span class="font-bold">{{ $jumlah }}</span> mahasiswa</li>
            @empty
                <li class="text-gray-500">Belum ada data program studi.</li>
            @endforelse
        </ul>
    </div>

    <!-- Pengumuman Terbaru -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-4">
        <h2 class="text-lg font-semibold text-indigo-600 mb-2">Pengumuman Terbaru</h2>
        <ul class="text-sm text-gray-700 space-y-4">
            @forelse ($pengumuman as $item)
                <li class="border-b pb-2">
                    <div class="font-semibold">{{ $item->judul }}</div>
                    <div class="text-xs text-gray-500 mb-1">
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y H:i') }}
                    </div>
                    <div class="text-sm text-gray-700">{{ $item->isi }}</div>
                    @if ($item->file_path)
                        <a href="{{ asset('storage/' . $item->file_path) }}"
                           class="inline-block mt-2 px-3 py-1 bg-indigo-600 text-white text-xs rounded hover:bg-indigo-700"
                           target="_blank" download>
                            <i class="bi bi-download mr-1"></i>Download File
                        </a>
                    @endif
                </li>
            @empty
                <li class="text-sm text-gray-500">Belum ada pengumuman.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
