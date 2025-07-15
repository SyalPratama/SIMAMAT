<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetorTugas extends Model
{
    use HasFactory;

    protected $table = 'setor_tugas';

    protected $fillable = [
        'tugas_id',
        'mahasiswa_id',
        'file_path',
        'catatan',
        'tanggal_setor',
        'status',
        'nilai',
        'komentar',
    ];

    public $timestamps = false; // karena kamu tidak pakai created_at / updated_at

    // Relasi ke tabel tugas
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    // Relasi ke tabel users sebagai mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
}
