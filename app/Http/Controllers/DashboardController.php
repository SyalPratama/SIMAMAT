<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function superadmin()
    {
        return view('admin.index');
    }

    public function dosen()
    {
        return view('dosen.index');
    }

    public function mahasiswa()
    {
        return view('mahasiswa.index');
    }
}
