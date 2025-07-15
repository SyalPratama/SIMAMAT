<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;
    protected $table = 'pengumuman';
    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'dibuat_oleh',
        'file_path',
        'target_audience',
    ];

    public $timestamps = false;
}
