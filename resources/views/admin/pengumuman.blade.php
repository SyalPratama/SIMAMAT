@extends('layouts.admin.head')

@section('title', 'Kelola Pengumuman')

@section('konten')
<div class="flex-1 overflow-y-auto px-4 pb-20 py-3 w-full max-w-sm mx-auto scroll-mobile">

    <div class="flex justify-between items-center mb-4">
        <!-- Kiri: Tombol kembali & Judul -->
        <div class="flex items-center gap-2">
            
            <h1 class="text-xl font-semibold text-gray-800">
                Daftar Pengumuman
            </h1>
        </div>

        <!-- Kanan: Tombol Tambah -->
        <a href="{{ route('admin.announcement.create') }}"
           class="px-3 py-1.5 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
            + Tambah 
        </a>
    </div>

    @if($announcements->isEmpty())
        <p class="text-gray-500">Belum ada data pengumuman.</p>
    @else
        <ul class="divide-y text-sm">
            @foreach ($announcements as $announcement)
                <li class="py-3">
                    <div class="bg-white p-4 rounded-xl shadow flex justify-between items-start">
                        <div>
                            <div class="font-medium text-gray-900">{{ $announcement->judul }}</div>
                            <div class="text-xs text-gray-500">{{ Str::limit($announcement->isi, 50) }}</div>
                            <div class="text-xs text-gray-500 capitalize mt-1">
                                Audience: {{ $announcement->target_audience }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ \Carbon\Carbon::parse($announcement->created_at)->format('d M Y') }}

                            </div>
                        </div>
                        <div class="space-x-1 whitespace-nowrap">
                            <a href="{{ route('admin.announcement.edit', $announcement->id) }}"
                               class="text-xs text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.announcement.destroy', $announcement->id) }}"
                                  method="POST" class="inline form-hapus">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-600 hover:underline btn-hapus">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

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
            width: '20%',
            customClass: {
                popup: 'text-sm',
                title: 'text-base font-semibold',
                content: 'text-sm'
            }
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            width: '20%',
            customClass: {
                popup: 'text-sm',
                title: 'text-base font-semibold',
                content: 'text-sm'
            }
        });
    @endif

    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('form');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data pengumuman akan dihapus permanen!",
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
