<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Imports\CRUDDosenImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class CRUDDosenController extends Controller
{
    // Menampilkan halaman CRUD
    public function index()
    {
        $dosen = Dosen::all();
        return view('components.crud_dosen', compact('dosen'));
    }

    // Menambah akun dosen
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dosen',
        ]);

        Dosen::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
        ]);

        return redirect()->route('dosen.index')->with('success', 'Akun dosen berhasil ditambahkan.');
    }

    // Menghapus akun dosen
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->user()->delete();
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Akun dosen berhasil dihapus.');
    }

    // Fungsi Import Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new CRUDDosenImport, $request->file('file'));

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diimpor.');
    }
}
