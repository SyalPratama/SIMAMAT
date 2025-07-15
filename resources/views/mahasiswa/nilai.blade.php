@extends('layouts.mahasiswa.head')

@section('title', 'Data Nilai')

@section('konten')

<!-- Loader -->
<div id="loader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
    <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-indigo-600 border-opacity-50"></div>
</div>

<!-- Main Content -->
<div id="content" class="flex-1 overflow-y-auto px-4 py-3 w-full max-w-sm mx-auto scroll-mobile hidden">
    <h1 class="text-xl font-semibold text-gray-800 mb-4">
        Daftar Nilai Anda
    </h1>

    @if ($nilai->isEmpty())
        <div class="bg-white rounded-xl shadow-md p-4 mb-16">
            <h2 class="text-lg font-semibold text-indigo-600 mb-2">Nilai Mahasiswa</h2>
            <p class="text-sm text-gray-600">Belum ada data nilai.</p>
        </div>
    @else
        @foreach ($nilai as $matkul => $list)
            <div class="bg-white rounded-xl shadow-md p-4 mb-6">
                <h2 class="text-lg font-semibold text-indigo-600 mb-2">{{ $matkul }}</h2>
                <ul class="text-sm text-gray-700 space-y-2">
                    @foreach ($list as $index => $data)
                        <li class="flex justify-between items-start">
                            <div>
                                <span class="font-semibold">{{ $index + 1 }}. {{ $data->mahasiswa->name }}</span><br>
                                <span class="text-xs text-gray-500">
                                    {{ $data->tugas->judul ?? '-' }} – {{ $data->mahasiswa->prodi->nama_prodi ?? '-' }}
                                </span>
                            </div>
                            <span class="font-bold text-indigo-600">{{ $data->nilai ?? '-' }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    @endif
</div>

@endsection
