<?php

namespace App\Http\Controllers;

use App\Models\DataMahasiswa; // Model untuk DataMahasiswa
use App\Models\User; // Model untuk User
use Illuminate\Http\Request;
use App\Imports\MahasiswaImport; // Import MahasiswaImport
use Maatwebsite\Excel\Facades\Excel; // Import Excel

class DataMahasiswaController extends Controller
{
    // Menampilkan data mahasiswa pada halaman utama
    public function index()
    {
        return $this->showData('mahasiswa_');
    }

    // Menampilkan data mahasiswa pada halaman Pa (Pembimbing Akademik)
    public function indexPa()
    {
        return $this->showData('mahasiswa__pa');
    }

    // Menampilkan data mahasiswa pada halaman Kap (Kaprodi)
    public function indexKap()
    {
        return $this->showData('mahasiswa__kap');
    }

    // Menampilkan data mahasiswa berdasarkan view yang dipilih
    private function showData($view)
    {
        $data_mahasiswa = DataMahasiswa::all(); // Mengambil semua data mahasiswa
        return view($view, compact('data_mahasiswa')); // Mengubah view yang digunakan
    }

    // Menyimpan data mahasiswa baru
    public function store(Request $request)
    {
        $request->validate($this->validationRules()); // Validasi data yang diinputkan

        DataMahasiswa::create($request->all()); // Menyimpan data mahasiswa
        return redirect()->back()->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    // Menampilkan halaman untuk mengedit data mahasiswa
    public function edit($id)
    {
        $data_mahasiswa = DataMahasiswa::findOrFail($id); // Mengambil data mahasiswa berdasarkan ID
        return view('edit_mahasiswa', compact('data_mahasiswa')); // Mengubah view yang digunakan
    }

    // Menampilkan halaman untuk mengedit data mahasiswa Kaprodi
    public function editKap($id)
    {
        $data_mahasiswa = DataMahasiswa::findOrFail($id); // Mengambil data mahasiswa berdasarkan ID
        return view('edit_mahasiswa__kap', compact('data_mahasiswa')); // Mengubah view yang digunakan
    }

    // Menampilkan halaman untuk mengedit data mahasiswa Pembimbing Akademik
    public function editPa($id)
    {
        $data_mahasiswa = DataMahasiswa::findOrFail($id); // Mengambil data mahasiswa berdasarkan ID
        return view('edit_mahasiswa__pa', compact('data_mahasiswa')); // Mengubah view yang digunakan
    }

    // Memperbarui data mahasiswa
    public function update(Request $request, $id)
    {
        $data_mahasiswa = DataMahasiswa::findOrFail($id); // Mengambil data mahasiswa berdasarkan ID

        $request->validate($this->validationRules($id)); // Pastikan validasi sesuai dengan ID yang ada

        // Update data mahasiswa, hanya ubah password jika ada input baru
        $data_mahasiswa->fill($request->except('password'));
        if ($request->filled('password')) {
            $data_mahasiswa->password = bcrypt($request->password); // Enkripsi password jika ada perubahan
        }
        $data_mahasiswa->save(); // Menyimpan perubahan

        return redirect()->route('data_mahasiswa.index')->with('success', 'Data mahasiswa berhasil diubah.');
    }

    // Memperbarui data mahasiswa Kaprodi
    public function updateKap(Request $request, $id)
    {
        $data_mahasiswa = DataMahasiswa::findOrFail($id);

        $request->validate($this->validationRules($id));

        // Update data mahasiswa Kaprodi
        $data_mahasiswa->fill($request->except('password'));
        if ($request->filled('password')) {
            $data_mahasiswa->password = bcrypt($request->password);
        }
        $data_mahasiswa->save();

        return redirect()->route('data_mahasiswa__kap.index')->with('success', 'Data mahasiswa Kaprodi berhasil diubah.');
    }

    // Memperbarui data mahasiswa Pembimbing Akademik
    public function updatePa(Request $request, $id)
    {
        $data_mahasiswa = DataMahasiswa::findOrFail($id);

        $request->validate($this->validationRules($id));

        // Update data mahasiswa Pembimbing Akademik
        $data_mahasiswa->fill($request->except('password'));
        if ($request->filled('password')) {
            $data_mahasiswa->password = bcrypt($request->password);
        }
        $data_mahasiswa->save();

        return redirect()->route('data_mahasiswa__pa.index')->with('success', 'Data mahasiswa Pembimbing Akademik berhasil diubah.');
    }

    // Menghapus data mahasiswa
    public function destroy($id)
    {
        DataMahasiswa::destroy($id);
        return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    // Mengubah status mahasiswa
    public function toggleStatus($id)
    {
        $data_mahasiswa = DataMahasiswa::findOrFail($id);
        $data_mahasiswa->status = !$data_mahasiswa->status;
        $data_mahasiswa->save();
        return redirect()->back()->with('success', 'Status mahasiswa berhasil diubah.');
    }

    // Mengimpor data mahasiswa dari file Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new MahasiswaImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diimpor.');
    }

    // Validasi untuk inputan mahasiswa
    private function validationRules($id = null)
    {
        return [
            'nama_lengkap' => 'required|string|max:255',
            'npm' => 'required|string|unique:data_mahasiswa_,npm,' . $id,
            'angkatan' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:data_mahasiswa_,email,' . $id,
            'password' => 'nullable|string|min:8',
        ];
    }

    // Menyimpan data mahasiswa dan akun user
    public function storeMahasiswa(Request $request)
    {
        $request->validate($this->validationRules());

        // Membuat akun user untuk mahasiswa
        $user = User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'mahasiswa', // Menetapkan role mahasiswa
        ]);

        // Menyimpan data mahasiswa terkait
        DataMahasiswa::create([
            'user_id' => $user->id,
            'nama_lengkap' => $request->nama_lengkap,
            'npm' => $request->npm,
            'angkatan' => $request->angkatan,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Akun mahasiswa berhasil ditambahkan.');
    }
}
