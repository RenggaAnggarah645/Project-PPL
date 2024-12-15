<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa; // Pastikan Anda memiliki model Mahasiswa
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CRUDMahasiswaImport; // Import class import yang baru dibuat

class CRUDMahasiswaController extends Controller
{
    // Menampilkan halaman CRUD
    public function index()
    {
        $mahasiswa = Mahasiswa::all(); // Mengambil data mahasiswa beserta user
        return view('components.crud_mahasiswa', compact('mahasiswa'));
    }

    // Menyimpan data mahasiswa
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:20|unique:mahasiswas',
            'angkatan' => 'required|string|max:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $user->id,
            'nama' => $validatedData['nama'],
            'npm' => $validatedData['npm'],
            'angkatan' => $validatedData['angkatan'],
            'email' => $validatedData['email'],
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    // Menghapus data mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->user->delete(); // Hapus juga user yang terkait
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    // Mengimpor data mahasiswa dari file Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new CRUDMahasiswaImport, $request->file('file'));

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diimpor.');
    }
}
