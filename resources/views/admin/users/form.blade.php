@extends('layouts.admin.head')

@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Pengguna')

@section('konten')
    <div class="flex-1 overflow-y-auto px-4 py-3 pb-28 w-full max-w-sm mx-auto scroll-mobile">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.user.byrole', ['role' => $user->role ?? 'mahasiswa']) }}" class="text-indigo-600 hover:text-indigo-800 text-lg">
                    <i class="bi bi-arrow-left"></i>
                </a>
                
                <h1 class="text-xl font-semibold text-gray-800">
                    {{ $isEdit ? 'Edit Pengguna' : 'Tambah Pengguna' }}
                </h1>
            </div>
        </div>

        <form action="{{ $isEdit ? route('admin.user.update', $user->id) : route('admin.user.store') }}" method="POST"
            enctype="multipart/form-data" class="bg-white rounded-xl shadow-md p-4 space-y-5">
            @csrf
            @if ($isEdit)
                @method('PUT')
            @endif

            <!-- Nama -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm"
                    value="{{ old('name', $user->name ?? '') }}" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm"
                    value="{{ old('email', $user->email ?? '') }}" required>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm"
                    required>
                    <option value="">Pilih Status</option>
                    <option value="active" {{ old('status', $user->status ?? '') == 'active' ? 'selected' : '' }}>Aktif
                    </option>
                    <option value="suspend" {{ old('status', $user->status ?? '') == 'suspend' ? 'selected' : '' }}>
                        Nonaktif</option>
                    <option value="lulus" {{ old('status', $user->status ?? '') == 'lulus' ? 'selected' : '' }}>Lulus
                    </option>
                </select>
            </div>


            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm"
                    required>
                    <option value="">Pilih Role</option>
                    <option value="mahasiswa" {{ old('role', $user->role ?? '') == 'mahasiswa' ? 'selected' : '' }}>
                        Mahasiswa</option>
                    <option value="dosen" {{ old('role', $user->role ?? '') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                    <option value="superadmin" {{ old('role', $user->role ?? '') == 'superadmin' ? 'selected' : '' }}>Staf
                    </option>
                </select>
            </div>

            <!-- Bagian Mahasiswa -->
            <div id="mahasiswaFields" class="hidden">
                <div>
                    <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" name="nim" id="nim"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm"
                        value="{{ old('nim', $user->nim ?? '') }}">
                </div>

                <div>
                    <label for="prodi_id" class="block text-sm font-medium text-gray-700">Program Studi</label>
                    <select name="prodi_id" id="prodi_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        <option value="">Pilih Prodi</option>
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->id }}"
                                {{ old('prodi_id', $user->prodi_id ?? '') == $prodi->id ? 'selected' : '' }}>
                                {{ $prodi->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="semester_id" class="block text-sm font-medium text-gray-700">Semester</label>
                    <select name="semester_id" id="semester_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        <option value="">Pilih Semester</option>
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}"
                                {{ old('semester_id', $user->semester_id ?? '') == $semester->id ? 'selected' : '' }}>
                                Semester {{ $semester->semester_ke }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Bagian Dosen -->
            <div id="dosenFields" class="hidden">
                <div>
                    <label for="nidn" class="block text-sm font-medium text-gray-700">NIDN</label>
                    <input type="text" name="nidn" id="nidn"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm"
                        value="{{ old('nidn', $user->nidn ?? '') }}">
                </div>
            </div>

            <!-- Bagian Staf -->
            <div id="stafFields" class="hidden">
                <div>
                    <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                    <input type="text" name="nip" id="nip"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm"
                        value="{{ old('nip', $user->nip ?? '') }}">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    {{ $isEdit ? 'Password (opsional)' : 'Password' }}
                </label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm" {{ $isEdit ? '' : 'required' }}
                    placeholder="{{ $isEdit ? 'Biarkan kosong jika tidak diubah' : '' }}">
            </div>

            <!-- Tombol -->
            <div class="flex justify-end pt-2">
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700 w-full">
                    {{ $isEdit ? 'Perbarui Data' : 'Tambah Data' }}
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const mahasiswaFields = document.getElementById('mahasiswaFields');
            const dosenFields = document.getElementById('dosenFields');
            const stafFields = document.getElementById('stafFields');

            function toggleFields() {
                const role = roleSelect.value;
                mahasiswaFields.classList.toggle('hidden', role !== 'mahasiswa');
                dosenFields.classList.toggle('hidden', role !== 'dosen');
                stafFields.classList.toggle('hidden', role !== 'superadmin');
            }

            roleSelect.addEventListener('change', toggleFields);
            toggleFields(); // panggil di awal untuk inisialisasi
        });
    </script>
@endsection
