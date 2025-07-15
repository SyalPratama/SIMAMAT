<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_tugas',
        'tanggal_dibuat',
        'tanggal_deadline',
        'dosen_id',
        'mata_kuliah_id',
    ];

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    public function setorTugas()
    {
        return $this->hasMany(SetorTugas::class, 'tugas_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
