{{-- resources/views/dosen/tugas.blade.php --}}
@extends('layouts.dosen.head')

@section('title', 'Daftar Tugas')

@section('konten')
<div class="flex-1 overflow-y-auto px-4 py-3 w-full max-w-sm mx-auto scroll-mobile">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center gap-2">
            <a href="javascript:history.back()" class="text-indigo-600 hover:text-indigo-800 text-lg">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="text-xl font-semibold text-gray-800">Daftar Tugas</h1>
        </div>
        <a href="{{ route('tugas.create') }}" class="px-3 py-1 text-xs bg-indigo-600 text-white rounded hover:bg-indigo-700">
            <i class="bi bi-plus-lg mr-1"></i>Tambah
        </a>
    </div>
    

    <!-- Daftar Tugas -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-20">
        <ul class="text-sm text-gray-700 space-y-6">
            @forelse ($tugas as $item)
                <li class="border-b pb-4">
                    <div class="font-semibold text-base text-indigo-700">{{ $item->judul }}</div>
                    <div class="text-xs text-gray-500 mt-1">
                        <strong>Semester:</strong> {{ $item->matakuliah->semester->semester_ke ?? '-' }} <br>
                        <strong>Prodi:</strong> {{ $item->matakuliah->prodi->nama_prodi ?? '-' }} <br>
                        <strong>Mata Kuliah:</strong> {{ $item->matakuliah->nama_mk ?? '-' }} <br>
                        <strong>Deadline:</strong> {{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('d F Y') }}
                    </div>
                    <div class="text-sm text-gray-700 mt-2">{{ $item->deskripsi }}</div>
                    @if ($item->file)
                        <a href="{{ asset('storage/' . $item->file) }}" class="inline-block mt-3 px-3 py-1 bg-indigo-600 text-white text-xs rounded hover:bg-indigo-700" target="_blank" download>
                            <i class="bi bi-download mr-1"></i>Download File
                        </a>
                    @endif
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('tugas.show', $item->id) }}" class="px-3 py-1 text-xs text-white bg-blue-500 rounded hover:bg-blue-600">
                            <i class="bi bi-eye-fill mr-1"></i>Detail
                        </a>
                        <a href="{{ route('tugas.edit', $item->id) }}" class="px-3 py-1 text-xs text-white bg-yellow-500 rounded hover:bg-yellow-600">
                            <i class="bi bi-pencil-fill mr-1"></i>Edit
                        </a>
                        <form action="{{ route('tugas.destroy', $item->id) }}" method="POST" class="form-hapus">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-hapus px-3 py-1 text-xs text-white bg-red-500 rounded hover:bg-red-600">
                                <i class="bi bi-trash-fill mr-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="text-sm text-gray-500">Belum ada tugas.</li>
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
<script>
    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tugas akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                width: '320px',
                customClass: {
                    popup: 'text-sm',
                    title: 'text-sm font-semibold',
                    htmlContainer: 'text-xs',
                    actions: 'space-x-2',
                    confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs',
                    cancelButton: 'bg-gray-300 hover:bg-gray-400 text-gray-800 px-3 py-1 rounded text-xs'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@endsection
