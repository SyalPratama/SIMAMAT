<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;

class KelolaUserController extends Controller
{
    public function index()
    {
        // Hitung jumlah berdasarkan role
        $jumlahMahasiswa = User::where('role', 'mahasiswa')->count();
        $jumlahDosen = User::where('role', 'dosen')->count();
        $jumlahStaf = User::where('role', 'superadmin')->count();

        // Kirim ke view
        return view('admin.user', compact(
            'jumlahMahasiswa',
            'jumlahDosen',
            'jumlahStaf',
        ));
    }

    public function byRole($role)
    {
        $users = User::where('role', $role)->get();

        return view('admin.users.by-role', compact('users', 'role'));
    }

    public function create()
    {
        return view('admin.users.form', [
            'user' => null,
            'isEdit' => false,
            'prodis' => Prodi::all(),
            'semesters' => Semester::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:mahasiswa,dosen,superadmin',
            'password' => 'required|min:6',
            'status' => 'required|in:active,suspend,lulus',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->password = bcrypt($request->password);

        // Role Mahasiswa
        if ($request->role === 'mahasiswa') {
            $user->nim = $request->nim;
            $user->prodi_id = $request->prodi_id;
            $user->semester_id = $request->semester_id;
        }

        // Role Dosen
        if ($request->role === 'dosen') {
            $user->nidn = $request->nidn;
        }

        // Role Superadmin (Staf)
        if ($request->role === 'superadmin') {
            $user->nip = $request->nip;
        }

        $user->save();

        return redirect()
            ->route('admin.user.byrole', ['role' => $user->role])
            ->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.form', [
            'user' => $user,
            'isEdit' => true,
            'prodis' => Prodi::all(),
            'semesters' => Semester::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:mahasiswa,dosen,superadmin',
            'password' => 'nullable|min:6',
            'status' => 'required|in:active,suspend,lulus',
        ]);

        // Update data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Jika role mahasiswa, update NIM, prodi, semester
        if ($user->role === 'mahasiswa') {
            $user->nim = $request->nim;
            $user->prodi_id = $request->prodi_id;
            $user->semester_id = $request->semester_id;
        }

        // Jika staf/dosen, update NIP/NIDN
        if ($user->role === 'dosen' || $user->role === 'superadmin') {
            $user->nip = $request->nip;
        }

        $user->save();

        return redirect()->route('admin.user.byrole', ['role' => $user->role])
                 ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $role = $user->role; // simpan role sebelum dihapus
        $user->delete();

        return redirect()->route('admin.user.byrole', ['role' => $role])
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
