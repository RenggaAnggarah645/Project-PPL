<?php

namespace App\Http\Controllers;

use App\Models\DataMahasiswa;
use App\Models\Dosen;  // Menggunakan model Dosen, bukan DataDosen
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class PembimbingAkademikController extends Controller
{
    // Menampilkan daftar pembimbing akademik
    public function index(Request $request)
    {
        $dosen = Dosen::all(); // Mengambil semua data dosen menggunakan model Dosen
        $mahasiswa = $this->filterMahasiswa($request);

        return view('pembimbing-akademik', compact('mahasiswa', 'dosen'));
    }

    // Menampilkan halaman pembimbing akademik untuk PA
    public function indexPA(Request $request)
    {
        $dosen = Dosen::all(); // Mengambil semua data dosen menggunakan model Dosen
        $mahasiswa = $this->filterMahasiswa($request);

        return view('pembimbing-akademik-PA', compact('mahasiswa', 'dosen'));
    }

    // Menyimpan pembimbing akademik untuk satu mahasiswa
    public function storePembimbing(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:data_mahasiswa,id',
            'dosen_id' => 'required|exists:dosen,id',  // Menggunakan tabel dosen, bukan data_dosen
        ]);

        $mahasiswa = DataMahasiswa::findOrFail($request->mahasiswa_id);
        $mahasiswa->dosen_pembimbing_id = $request->dosen_id;
        $mahasiswa->save();

        return redirect()->route('pembimbing-akademik.index')
            ->with('success', 'Pembimbing akademik berhasil disimpan.');
    }

    // Menyimpan pembimbing akademik untuk beberapa mahasiswa
    public function storeMultiple(Request $request)
{
    $request->validate([
        'dosen_id' => 'required|exists:dosens,id', // Validasi dosen
        'mahasiswa_ids' => 'required|array', // Pastikan ada mahasiswa yang dipilih
        'mahasiswa_ids.*' => 'exists:data_mahasiswa_,id', // Validasi masing-masing ID mahasiswa
    ]);

    // Update semua mahasiswa yang dipilih dengan dosen pembimbing
    DataMahasiswa::whereIn('id', $request->mahasiswa_ids)
        ->update(['dosen_pembimbing_id' => $request->dosen_id]);

    return redirect()->route('pembimbing-akademik.index')
        ->with('success', 'Pembimbing akademik berhasil diperbarui untuk mahasiswa terpilih.');
}


    // Mencetak daftar pembimbing akademik ke PDF
    public function printPDF(Request $request)
    {
        $data = $this->filterMahasiswa($request, false);

        $pdf = PDF::loadView('pdf.pembimbing-akademik', compact('data'));
        return $pdf->download('pembimbing-akademik.pdf');
    }

    // Fungsi untuk memfilter mahasiswa berdasarkan request
    private function filterMahasiswa(Request $request, $paginate = true)
    {
        $query = DataMahasiswa::with('dosen_pembimbing')
            ->when($request->dosen_id, function ($query) use ($request) {
                return $query->where('dosen_pembimbing_id', $request->dosen_id);
            })
            ->when($request->angkatan, function ($query) use ($request) {
                return $query->where('angkatan', $request->angkatan);
            });

        return $paginate ? $query->paginate(10) : $query->get();
    }
}
