<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dosen\DashboardDosenController;
use App\Http\Controllers\Dosen\TugasController;
use App\Http\Controllers\Mahasiswa\DashboardMahasiswaController;
use App\Http\Controllers\Mahasiswa\NilaiController;
use App\Http\Controllers\Mahasiswa\TugasMahasiswaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/superadmin', [DashboardController::class, 'superadmin'])->name('dashboard.superadmin');

    // DOSEN
    Route::get('/dashboard/dosen', [DashboardController::class, 'dosen'])->name('dashboard.dosen');
    Route::get('/dashboard/dosen', [DashboardDosenController::class, 'index'])->name('dashboard.dosen')->middleware('auth');
    Route::get('/pengumuman', [PengumumanController::class, 'dosen'])->name('pengumuman.index');
    Route::resource('/tugas', TugasController::class)->middleware('auth');
    Route::get('/tugas/matakuliah/{id}', [TugasController::class, 'byMatakuliah'])->name('tugas.byMatakuliah');
    Route::get('/tugas/{id}', [TugasController::class, 'show'])->name('tugas.show');
    Route::put('/setor-tugas/{id}', [TugasController::class, 'updateSetor'])->name('setor-tugas.update');

    // MAHASISWA
    Route::get('/dashboard/mahasiswa', [DashboardController::class, 'mahasiswa'])->name('dashboard.mahasiswa');
    Route::get('/dashboard/mahasiswa', [DashboardMahasiswaController::class, 'index'])->name('dashboard.mahasiswa')->middleware('auth');
    Route::get('/mahasiswa/nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::get('/mahasiswa/tugas', [TugasMahasiswaController::class, 'indexMahasiswa'])->name('mahasiswa.tugas.index');
    Route::get('/mahasiswa/tugas/{id}/kerjakan', [TugasMahasiswaController::class, 'kerjakan'])->name('mahasiswa.tugas.kerjakan');
    Route::post('/mahasiswa/tugas/{id}/kerjakan', [TugasMahasiswaController::class, 'storeJawaban'])->name('mahasiswa.tugas.storeJawaban');
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
