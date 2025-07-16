@extends('layouts.admin.head')

@section('title', 'Dashboard Admin')

@section('konten')

<!-- Loader -->
<div id="loader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
    <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-indigo-600 border-opacity-50"></div>
</div>

<!-- Main Content -->
<div class="flex-1 overflow-y-auto px-4 pb-20 py-3 w-full max-w-sm mx-auto scroll-mobile">

    <div class="mb-4">
        <h1 class="text-xl font-semibold text-gray-800">Kelola User</h1>
    </div>

    <!-- Statistik Jumlah dengan Tombol -->
    <div class="space-y-2 mb-4">
        <!-- Mahasiswa -->
        <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center">
            <div>
                <h3 class="text-sm text-gray-500 mb-1">Jumlah Mahasiswa</h3>
                <p class="text-2xl font-bold text-indigo-600">{{ $jumlahMahasiswa }}</p>
            </div>
            <a href="{{ route('admin.user.byrole', ['role' => 'mahasiswa']) }}"
               class="ml-4 px-3 py-1.5 text-xs font-medium bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                Kelola
            </a>
        </div>

        <!-- Dosen -->
        <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center">
            <div>
                <h3 class="text-sm text-gray-500 mb-1">Jumlah Dosen</h3>
                <p class="text-2xl font-bold text-green-600">{{ $jumlahDosen }}</p>
            </div>
            <a href="{{ route('admin.user.byrole', ['role' => 'dosen']) }}"
               class="ml-4 px-3 py-1.5 text-xs font-medium bg-green-600 text-white rounded hover:bg-green-700 transition">
                Kelola
            </a>
        </div>

        <!-- Staf -->
        <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center">
            <div>
                <h3 class="text-sm text-gray-500 mb-1">Jumlah Staf</h3>
                <p class="text-2xl font-bold text-yellow-600">{{ $jumlahStaf }}</p>
            </div>
            <a href="{{ route('admin.user.byrole', ['role' => 'superadmin']) }}"
               class="ml-4 px-3 py-1.5 text-xs font-medium bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                Kelola
            </a>
        </div>
    </div>

</div>
@endsection
