<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'dosen_id',
        'prodi_id',
        'semester_id',
    ];

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
}
