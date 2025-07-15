@include('layouts.dosen.head')

@section('title', 'Edit Tugas')

@section('konten')

<div class="flex-1 overflow-y-auto px-4 py-3 pb-28 w-full max-w-sm mx-auto scroll-mobile">
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center gap-2">
            <a href="javascript:history.back()" class="text-indigo-600 hover:text-indigo-800 text-lg">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="text-xl font-semibold text-gray-800">Edit Tugas</h1>
        </div>
    </div>

    <form action="{{ route('tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-xl shadow-md p-4 space-y-5">
        @csrf
        @method('PUT')

        <!-- Judul Tugas -->
        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
            <input type="text" name="judul" id="judul"
                   value="{{ old('judul', $tugas->judul) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                   required>
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                      required>{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
        </div>

        <!-- Mata Kuliah -->
        <div>
            <label for="mata_kuliah_id" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
            <select name="mata_kuliah_id" id="mata_kuliah_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                    required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach ($matakuliahs as $mk)
                    <option value="{{ $mk->id }}" {{ $tugas->mata_kuliah_id == $mk->id ? 'selected' : '' }}>
                        {{ $mk->nama_mk }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Deadline -->
        <div>
            <label for="tanggal_deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
            <input type="date" name="tanggal_deadline" id="tanggal_deadline"
                   value="{{ old('tanggal_deadline', \Carbon\Carbon::parse($tugas->tanggal_deadline)->format('Y-m-d')) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                   required>
        </div>

        <!-- Upload File Baru -->
        <div>
            <label for="file" class="block text-sm font-medium text-gray-700">Upload File (opsional)</label>
            <input type="file" name="file" id="file"
                   class="mt-1 block w-full text-sm text-gray-700">
            @if ($tugas->file_tugas)
                <p class="mt-1 text-xs text-gray-500">File saat ini:
                    <a href="{{ asset('storage/' . $tugas->file_tugas) }}" target="_blank" class="text-indigo-600 underline">
                        Lihat File
                    </a>
                </p>
            @endif
        </div>

        <!-- Tombol Simpan -->
        <div class="flex justify-end pt-2">
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700 w-full">
                Update Tugas
            </button>
        </div>
    </form>
</div>

@show

@include('layouts.dosen.footer')
