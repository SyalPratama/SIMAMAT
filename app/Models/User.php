<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nim',
        'nidn',
        'nip',
        'role',
        'status',
        'prodi_id',
        'semester_id',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function setoranTugas()
    {
        return $this->hasMany(SetorTugas::class, 'mahasiswa_id');
    }

    public function tugasDosen()
    {
        return $this->hasMany(Tugas::class, 'dosen_id');
    }
}
