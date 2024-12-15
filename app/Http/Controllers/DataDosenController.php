<?php

namespace App\Http\Controllers;

use App\Models\DataDosen; // Model yang digunakan
use App\Imports\DataDosenImport; // Import file import
use Maatwebsite\Excel\Facades\Excel; // Fasad Excel
use Illuminate\Http\Request;

class DataDosenController extends Controller
{
    // Menampilkan semua data dosen di halaman utama
    public function index()
    {
        $data_dosen = DataDosen::all();
        return view('data_dosen', compact('data_dosen'));
    }

    // Menampilkan semua data dosen di halaman data_dosen_kap
    public function indexKap()
    {
        $data_dosen = DataDosen::all();
        return view('data_dosen_kap', compact('data_dosen'));
    }

    // Menyimpan data dosen
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'required|string|unique:data_dosen',
            'email' => 'required|string|email|max:255|unique:data_dosen',
            'password' => 'required|string|min:8',
        ]);

        // Menyimpan data dosen
        DataDosen::create($request->all());
        return redirect()->back()->with('success', 'Data dosen berhasil ditambahkan.');
    }

    // Mengedit data dosen
    public function edit($id)
    {
        $data_dosen = DataDosen::findOrFail($id);
        return view('edit_data_dosen', compact('data_dosen'));
    }

    // Memperbarui data dosen
    public function update(Request $request, $id)
    {
        $data_dosen = DataDosen::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'required|string|unique:data_dosen,nip,' . $data_dosen->id,
            'email' => 'required|string|email|max:255|unique:data_dosen,email,' . $data_dosen->id,
            'password' => 'nullable|string|min:8',
        ]);

        $data_dosen->fill($request->except('password'));
        if ($request->filled('password')) {
            $data_dosen->password = bcrypt($request->password);
        }
        $data_dosen->save();

        return redirect()->route('data_dosen.index')->with('success', 'Data dosen berhasil diubah.');
    }

    // Mengedit data dosen KAP
    public function editKap($id)
    {
        $data_dosen = DataDosen::findOrFail($id);
        return view('edit_data_dosen_kap', compact('data_dosen'));
    }

    // Memperbarui data dosen KAP
    public function updateKap(Request $request, $id)
    {
        $data_dosen = DataDosen::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'required|string|unique:data_dosen,nip,' . $data_dosen->id,
            'email' => 'required|string|email|max:255|unique:data_dosen,email,' . $data_dosen->id,
            'password' => 'nullable|string|min:8',
        ]);

        $data_dosen->fill($request->except('password'));
        if ($request->filled('password')) {
            $data_dosen->password = bcrypt($request->password);
        }
        $data_dosen->save();

        return redirect()->route('data_dosen_kap.index')->with('success', 'Data dosen KAP berhasil diubah.');
    }

    // Menghapus data dosen
    public function destroy($id)
    {
        DataDosen::destroy($id);
        return redirect()->back()->with('success', 'Data dosen berhasil dihapus.');
    }

    // Mengubah status dosen
    public function toggleStatus($id)
    {
        $data_dosen = DataDosen::findOrFail($id);
        $data_dosen->status = !$data_dosen->status;
        $data_dosen->save();
        return redirect()->back()->with('success', 'Status dosen berhasil diubah.');
    }

    // Fungsi untuk mengimpor data dosen
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Mengimpor file
        Excel::import(new DataDosenImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data dosen berhasil diimpor.');
    }
}
