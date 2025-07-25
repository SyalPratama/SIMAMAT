<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_prodi'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function matkul()
    {
        return $this->hasMany(MataKuliah::class);
    }
}
