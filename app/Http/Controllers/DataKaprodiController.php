<?php

namespace App\Http\Controllers;

use App\Models\DataKaprodi; // Ubah model yang digunakan
use Illuminate\Http\Request;

class DataKaprodiController extends Controller
{
    public function index()
    {
        $data_kaprodi = DataKaprodi::all(); // Mengambil semua data kaprodi
        return view('data_kaprodi', compact('data_kaprodi')); // Mengubah view yang digunakan
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'required|string|unique:data_kaprodi', // Ubah referensi ke tabel data kaprodi
            'email' => 'required|string|email|max:255|unique:data_kaprodi', // Ubah referensi ke tabel data kaprodi
            'password' => 'required|string|min:8',
        ]);

        DataKaprodi::create($request->all()); // Menyimpan data kaprodi
        return redirect()->back()->with('success', 'Data kaprodi berhasil ditambahkan.'); // Mengubah pesan sukses
    }

    public function edit($id)
    {
        $data_kaprodi = DataKaprodi::findOrFail($id); // Mengambil data kaprodi berdasarkan ID
        return view('edit_data_kaprodi', compact('data_kaprodi')); // Mengubah view yang digunakan
    }

    public function update(Request $request, $id)
    {
        $data_kaprodi = DataKaprodi::findOrFail($id); // Mengambil data kaprodi berdasarkan ID

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'required|string|unique:data_kaprodi,nip,' . $data_kaprodi->id, // Ubah referensi ke tabel data kaprodi
            'email' => 'required|string|email|max:255|unique:data_kaprodi,email,' . $data_kaprodi->id, // Ubah referensi ke tabel data kaprodi
            'password' => 'nullable|string|min:8', // Password bisa diubah, jika ingin
        ]);

        // Hanya update password jika ada input baru
        $data_kaprodi->fill($request->except('password'));
        if ($request->filled('password')) {
            $data_kaprodi->password = bcrypt($request->password);
        }
        $data_kaprodi->save(); // Menyimpan perubahan

        return redirect()->route('data_kaprodi.index')->with('success', 'Data kaprodi berhasil diubah.'); // Mengubah rute pengalihan
    }

    public function destroy($id)
    {
        DataKaprodi::destroy($id); // Menghapus data kaprodi berdasarkan ID
        return redirect()->back()->with('success', 'Data kaprodi berhasil dihapus.'); // Mengubah pesan sukses
    }

    public function toggleStatus($id)
    {
        $data_kaprodi = DataKaprodi::findOrFail($id); // Mengambil data kaprodi berdasarkan ID
        $data_kaprodi->status = !$data_kaprodi->status; // Mengubah status
        $data_kaprodi->save(); // Menyimpan perubahan
        return redirect()->back()->with('success', 'Status kaprodi berhasil diubah.'); // Mengubah pesan sukses
    }
}
