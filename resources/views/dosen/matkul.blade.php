@extends('layouts.dosen.head')

@section('title', 'Mata Kuliah')

@section('konten')

<!-- Main Content -->
<div class="flex-1 overflow-y-auto px-4 py-3 w-full max-w-sm mx-auto scroll-mobile">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-800">
            Daftar Mata Kuliah
        </h1>
    </div>

    <!-- Daftar Mata Kuliah -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-4">
        <ul class="text-sm text-gray-700 space-y-4">
            @forelse ($mataKuliahs as $item)
                <li class="border-b pb-2">
                    <div class="font-semibold">{{ $item->nama_mk }}</div>
                    <div class="text-xs text-gray-500 mb-1">
                        Semester: {{ $item->semester->semester_ke ?? '-' }} <br>
                        Kode MK: {{ $item->kode_mk ?? '-' }} <br>
                        Prodi: {{ $item->prodi->nama_prodi ?? '-' }}
                    </div>
    
                    <!-- Tombol Kelola Tugas -->
                    <div class="mt-2 flex justify-end">
                        <a href="{{ route('tugas.byMatakuliah', $item->id) }}"
                           class="px-3 py-1 text-xs bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            <i class="bi bi-list-task mr-1"></i>Kelola Tugas
                        </a>
                    </div>
                </li>
            @empty
                <li class="text-sm text-gray-500">Belum ada mata kuliah yang ditugaskan.</li>
            @endforelse
        </ul>
    </div>
    
</div>

@endsection
