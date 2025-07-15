@extends('layouts.mahasiswa.head')

@section('title', 'Daftar Tugas')

@section('konten')

<!-- Loader -->
<div id="loader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
    <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-indigo-600 border-opacity-50"></div>
</div>

<div class="flex-1 overflow-y-auto px-4 py-3 pb-20 w-full max-w-sm mx-auto scroll-mobile">
    <h1 class="text-xl font-semibold text-gray-800 mb-4">Daftar Tugas</h1>

    @php
        $tugasGrouped = $tugas->groupBy(function($item) {
            return $item->mataKuliah->nama_mk ?? 'Tanpa Mata Kuliah';
        });
    @endphp

    @forelse($tugasGrouped as $namaMk => $list)
        <div class="bg-white rounded-xl shadow-md p-4 mb-6">
            <h2 class="text-lg font-semibold text-indigo-600 mb-3">{{ $namaMk }}</h2>
            <p class="text-xs text-gray-500 mb-2">
                Prodi: {{ $list->first()->mataKuliah->prodi->nama_prodi ?? '-' }} |
                Semester: {{ $list->first()->mataKuliah->semester->semester_ke ?? '-' }}
            </p>

            <ul class="space-y-4 text-sm text-gray-700">
                @foreach($list as $item)
                    @php
                        $sudahSetor = $item->setorTugas->isNotEmpty();
                        $deadlineTerlambat = \Carbon\Carbon::parse($item->tanggal_deadline)->isPast();
                    @endphp

                    <li class="border border-gray-200 rounded-md p-3">
                        <div class="mb-1">
                            <span class="font-semibold">{{ $item->judul }}</span>
                            <p class="text-xs text-gray-500 mt-1">
                                Dibuat: {{ $item->tanggal_dibuat }} |
                                Deadline: {{ \Carbon\Carbon::parse($item->tanggal_deadline)->translatedFormat('d F Y H:i') }}
                            </p>
                        </div>

                        <p class="text-sm mb-2">{{ $item->deskripsi }}</p>

                        <div class="flex flex-wrap gap-2">
                            @if ($sudahSetor)
                                <span class="px-3 py-1 text-xs font-medium text-white bg-gray-500 rounded">
                                    Anda sudah mengerjakan
                                </span>
                            @elseif ($deadlineTerlambat)
                                <span class="px-3 py-1 text-xs font-medium text-white bg-red-600 rounded">
                                    Deadline telah lewat
                                </span>
                            @else
                                <a href="{{ route('mahasiswa.tugas.kerjakan', $item->id) }}"
                                   class="px-3 py-1 text-xs font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700">
                                    Kerjakan Tugas
                                </a>
                            @endif

                            @if($item->file_tugas)
                                <a href="{{ asset('storage/' . $item->file_tugas) }}" target="_blank"
                                   class="px-3 py-1 text-xs font-medium text-white bg-green-600 rounded hover:bg-green-700">
                                    Download File
                                </a>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @empty
        <div class="bg-white rounded-xl shadow-md p-4">
            <p class="text-sm text-gray-600">Tidak ada tugas yang tersedia.</p>
        </div>
    @endforelse
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
