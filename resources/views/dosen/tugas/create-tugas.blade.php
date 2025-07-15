@include('layouts.dosen.head')

@section('title', 'Tambah Tugas')

@section('konten')

<div class="flex-1 overflow-y-auto px-4 py-3 pb-28 w-full max-w-sm mx-auto scroll-mobile">

    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center gap-2">
            <a href="javascript:history.back()" class="text-indigo-600 hover:text-indigo-800 text-lg">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="text-xl font-semibold text-gray-800">Tambah Tugas</h1>
        </div>
    </div>

    <form action="{{ route('tugas.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-xl shadow-md p-4 space-y-5">
        @csrf

        <!-- Judul Tugas -->
        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
            <input type="text" name="judul" id="judul"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                   required>
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                      required></textarea>
        </div>

        <!-- Mata Kuliah -->
        <!-- Mata Kuliah -->
        <div>
            <label for="mata_kuliah_id" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
            <select name="mata_kuliah_id" id="mata_kuliah_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                    required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach ($matakuliahs as $mk)
                    <option value="{{ $mk->id }}">
                        {{ $mk->nama_mk }}
                    </option>
                @endforeach
            </select>
        </div>


        <!-- Deadline -->
        <div>
            <label for="tanggal_deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
            <input type="date" name="tanggal_deadline" id="tanggal_deadline"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                   required>
        </div>

        <!-- Upload File -->
        <div>
            <label for="file" class="block text-sm font-medium text-gray-700">Upload File (opsional)</label>
            <input type="file" name="file" id="file"
                   class="mt-1 block w-full text-sm text-gray-700">
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end pt-2">
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700 w-full">
                Simpan Tugas
            </button>
        </div>
    </form>
</div>

@show

<script>
    function updateInfo() {
        const select = document.getElementById('mata_kuliah_id');
        const selected = select.options[select.selectedIndex];
        const semester = selected.getAttribute('data-semester') || '-';
        const prodi = selected.getAttribute('data-prodi') || '-';

        document.getElementById('semester_display').value = semester;
        document.getElementById('prodi_display').value = prodi;
    }
</script>

@include('layouts.dosen.footer')
