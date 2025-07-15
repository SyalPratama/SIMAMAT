@extends('layouts.dosen.head')

@section('title', 'Detail Tugas')

@section('konten')

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto px-4 py-3 pb-20 w-full max-w-sm mx-auto scroll-mobile">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center gap-2">
                <a href="javascript:history.back()" class="text-indigo-600 hover:text-indigo-800 text-lg">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h1 class="text-xl font-semibold text-gray-800">Rincian Setoran Tugas</h1>
            </div>
        </div>

        <!-- Rincian Setoran -->
        <div class="bg-white rounded-xl shadow-md p-4 mb-8">
            <ul class="text-sm text-gray-700 space-y-4">
                @forelse ($tugas->setorTugas as $setor)
                    <li class="border-b pb-3">
                        <div class="font-semibold">{{ $setor->mahasiswa->name ?? 'Mahasiswa' }}</div>
                        <div class="text-xs text-gray-500 mb-1">
                            NIM: {{ $setor->mahasiswa->nim ?? '-' }}<br>
                            Dikirim: {{ \Carbon\Carbon::parse($setor->created_at)->translatedFormat('d F Y H:i') }}
                        </div>

                        @if ($setor->file_path)
                            <div class="flex items-center gap-2 flex-wrap mt-1">
                                <a href="{{ asset('storage/' . $setor->file_path) }}" target="_blank"
                                    class="inline-block px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                    <i class="bi bi-file-earmark-arrow-down mr-1"></i>Lihat File
                                </a>
                                <a href="{{ asset('storage/' . $setor->file_path) }}" download
                                    class="inline-block px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">
                                    <i class="bi bi-download mr-1"></i>Unduh
                                </a>
                            </div>
                        @endif

                        {{-- Catatan dari Mahasiswa (tidak bisa diubah) --}}
                        @if ($setor->catatan)
                            <div class="mt-2">
                                <label class="block text-xs text-gray-500 mb-1">Catatan Mahasiswa</label>
                                <div class="text-xs text-gray-700 italic border rounded p-2 bg-gray-50">
                                    {{ $setor->catatan }}
                                </div>
                            </div>
                        @endif

                        {{-- Form Komentar dan Status --}}
                        <form action="{{ route('setor-tugas.update', $setor->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')

                            {{-- Nilai --}}
                            <div class="mb-3">
                                <label class="block text-xs text-gray-500 mb-1">Nilai</label>
                                <input type="number" name="nilai" min="0" max="100"
                                    class="w-full text-xs border rounded p-1" value="{{ $setor->nilai }}">
                            </div>

                            {{-- Status --}}
                            @php
                                $statuses = ['diterima', 'revisi', 'ditolak', 'terkirim'];
                            @endphp

                            <div class="mb-2">
                                <label class="block text-xs text-gray-500 mb-1">Status</label>
                                <select name="status" class="w-full text-xs border rounded p-1">
                                    <option value="">-- Pilih Status --</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}"
                                            {{ $setor->status == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- Komentar Dosen --}}
                            <div class="mb-2">
                                <label class="block text-xs text-gray-500 mb-1">Komentar Dosen</label>
                                <textarea name="komentar" rows="2" class="w-full text-xs border rounded p-1">{{ $setor->komentar }}</textarea>
                            </div>

                            {{-- Tombol Simpan --}}
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs px-3 py-1 rounded">
                                Simpan
                            </button>
                        </form>
                    </li>
                @empty
                    <li class="text-sm text-gray-500">Belum ada yang menyetor tugas.</li>
                @endforelse
            </ul>
        </div>

    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false,
                width: '20%', // Ukuran lebar disesuaikan untuk mobile
                customClass: {
                    popup: 'text-sm', // Ukuran teks lebih kecil
                    title: 'text-base font-semibold', // Kustomisasi judul
                    content: 'text-sm' // Kustomisasi isi konten
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                width: '90%',
                customClass: {
                    popup: 'text-sm',
                    title: 'text-base font-semibold',
                    content: 'text-sm'
                }
            });
        @endif
    </script>
@endsection
