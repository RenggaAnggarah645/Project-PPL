<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kaprodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CRUDKaprodiController extends Controller
{
    // Menampilkan halaman CRUD
    public function index()
    {
        $kaprodi = Kaprodi::with('user')->get();
        return view('components.crud_kaprodi', compact('kaprodi'));
    }

    // Menambah akun kaprodi
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Simpan data user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kaprodi',
        ]);

        // Simpan data kaprodi
        Kaprodi::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'nip' => $request->nip,
            'instansi' => $request->instansi,
            'email' => $request->email,
        ]);

        return redirect()->route('kaprodi.index')->with('success', 'Akun kaprodi berhasil ditambahkan.');
    }

    // Menghapus akun kaprodi
    public function destroy($id)
    {
        $kaprodi = Kaprodi::findOrFail($id);

        // Hapus data user terkait
        $kaprodi->user()->delete();

        // Hapus data kaprodi
        $kaprodi->delete();

        return redirect()->route('kaprodi.index')->with('success', 'Akun kaprodi berhasil dihapus.');
    }
}
