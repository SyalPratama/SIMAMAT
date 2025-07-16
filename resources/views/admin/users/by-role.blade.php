@extends('layouts.admin.head')

@section('title', 'Kelola ' . ucfirst($role))

@section('konten')
<div class="flex-1 overflow-y-auto px-4 pb-20 py-3 w-full max-w-sm mx-auto scroll-mobile">

    <div class="flex justify-between items-center mb-4">
        <!-- Kiri: Tombol kembali & Judul -->
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.user.index') }}" class="text-indigo-600 hover:text-indigo-800 text-lg">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="text-xl font-semibold text-gray-800">
                Daftar {{ ucfirst($role) }}
            </h1>
        </div>
    
        <!-- Kanan: Tombol Tambah -->
        <a href="{{ route('admin.user.create', ['role' => $role]) }}"
           class="px-3 py-1.5 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700">
            + Tambah 
        </a>
    </div>
    

    @if($users->isEmpty())
        <p class="text-gray-500">Belum ada data {{ $role }}.</p>
    @else
        <ul class="divide-y text-sm">
            @if ($role === 'mahasiswa')
                @foreach ($users->groupBy('prodi_id') as $prodiId => $groupedUsers)
                    <li class="py-2">
                        <h2 class="text-sm font-semibold text-gray-600 mb-2">
                            {{ $groupedUsers->first()->prodi->nama_prodi ?? 'Tanpa Prodi' }}
                        </h2>

                        @foreach ($groupedUsers as $user)
                            <div class="bg-white p-4 mb-2 rounded-xl shadow flex justify-between items-center">
                                <div>
                                    <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                    <div class="text-xs text-gray-500 capitalize">{{ $user->status }}</div>
                                    <div class="text-xs text-gray-500">
                                        Semester {{ $user->semester->semester_ke ?? '-' }}
                                    </div>
                                </div>
                                <div class="space-x-1">
                                    <a href="{{ route('admin.user.edit', $user->id) }}"
                                       class="text-xs text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline form-hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-600 hover:underline btn-hapus">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </li>
                @endforeach
            @else
                @foreach ($users as $user)
                    <li class="py-3">
                        <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center">
                            <div>
                                <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                <div class="text-xs text-gray-500 capitalize">{{ $user->status }}</div>
                            </div>
                            <div class="space-x-1">
                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                   class="text-xs text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline form-hapus">
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
            @endif
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
                text: "Data pengguna akan dihapus permanen!",
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
