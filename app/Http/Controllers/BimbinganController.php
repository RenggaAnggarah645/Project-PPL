<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BimbinganController extends Controller
{
    // Konstruktor untuk middleware auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman create bimbingan
    public function create()
    {
        // Mengambil data dosen yang sedang login berdasarkan email
        $dosen = Dosen::where('email', auth()->user()->email)->first();

        return view('proses_Bimbingan', compact('dosen'));
    }

    public function store(Request $request)
    {
        Bimbingan::create([
            'nama_dosen' => $request->nama_dosen,
            'nip' => $request->nip,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'npm' => $request->npm,
            'tanggal_bimbingan' => $request->tanggal_bimbingan,
            'topik_pembahasan' => $request->topik_pembahasan,
            'uraian_pembahasan' => $request->uraian_pembahasan,
            'angkatan' => $request->angkatan, // Menyimpan angkatan
            'tahun_awal' => $request->tahun_awal, // Menyimpan tahun awal
            'tahun_akhir' => $request->tahun_akhir, // Menyimpan tahun akhir
            'semester' => $request->semester, // Menyimpan semester
        ]);
        return redirect()->route('bimbingan.index')->with('success', 'Data Bimbingan berhasil ditambahkan!');
    }

    public function index()
    {
        // Ambil email pengguna yang sedang login
        $email = auth()->user()->email;

        // Ambil data dosen berdasarkan email
        $dosen = Dosen::where('email', $email)->first();

        if ($dosen) {
            // Ambil data bimbingan hanya untuk dosen yang sedang login dan pastikan nama dosen tidak duplikat
            $bimbingans = Bimbingan::where('nama_dosen', $dosen->name)->distinct('nama_dosen')->get();
            return view('lihat_hasil_Bimbingan', compact('bimbingans'));
        }

        // Jika dosen tidak ditemukan, arahkan ke halaman lain
        return redirect()->route('home')->with('error', 'Data dosen tidak ditemukan!');
    }

    public function indexKaprodi()
    {
        $bimbingans = Bimbingan::all();
        return view('lihat_hasil_Bimbingan_kap', compact('bimbingans'));
    }

    public function indexMahasiswa()
    {
        // Ambil data mahasiswa yang sedang login berdasarkan email user yang sedang login
        $email = auth()->user()->email;
        $mahasiswa = Mahasiswa::where('email', $email)->first();

        if ($mahasiswa) {
            // Ambil data bimbingan hanya untuk mahasiswa yang sedang login
            $bimbingans = Bimbingan::where('npm', $mahasiswa->npm)->get();
            return view('lihat_hasil_Bimbingan_mhs', compact('bimbingans'));
        }

        // Jika mahasiswa tidak ditemukan, arahkan ke halaman lain
        return redirect()->route('home')->with('error', 'Data mahasiswa tidak ditemukan!');
    }

    public function destroy($id)
    {
        Bimbingan::destroy($id);
        return redirect()->route('bimbingan.index')->with('success', 'Data Bimbingan berhasil dihapus!');
    }

    public function edit($id)
    {
        $bimbingan = Bimbingan::findOrFail($id);
        return view('edit_Bimbingan', compact('bimbingan'));
    }

    public function update(Request $request, $id)
    {
        Bimbingan::findOrFail($id)->update([
            'nama_dosen' => $request->nama_dosen,
            'nip' => $request->nip,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'npm' => $request->npm,
            'tanggal_bimbingan' => $request->tanggal_bimbingan,
            'topik_pembahasan' => $request->topik_pembahasan,
            'uraian_pembahasan' => $request->uraian_pembahasan,
            'angkatan' => $request->angkatan, // Mengupdate angkatan
        ]);
        return redirect()->route('bimbingan.index')->with('success', 'Data Bimbingan berhasil diubah!');
    }

    public function showByDosen($nama_dosen)
    {
        // Ambil data dosen yang sedang login
        $email = auth()->user()->email;
        $dosen = Dosen::where('email', $email)->first();

        if ($dosen && $dosen->name == $nama_dosen) {
            // Ambil data bimbingan berdasarkan nama dosen, tahun awal, tahun akhir, dan semester
            $bimbingans = Bimbingan::where('nama_dosen', $nama_dosen)
                ->where('tahun_awal', request()->query('tahun_awal'))
                ->where('tahun_akhir', request()->query('tahun_akhir'))
                ->where('semester', request()->query('semester'))
                ->get();

            return view('lihat_hasil_Bimbingan_dosen', compact('bimbingans', 'nama_dosen'));
        }

        return redirect()->route('home')->with('error', 'Data tidak ditemukan!');
    }

    public function showByDosenKaprodi($nama_dosen, Request $request)
    {
        // Mengambil parameter tahun_awal, tahun_akhir, dan semester dari request
        $tahun_awal = $request->query('tahun_awal');
        $tahun_akhir = $request->query('tahun_akhir');
        $semester = $request->query('semester');

        // Ambil data bimbingan untuk dosen yang sesuai dengan periode yang dipilih
        $bimbingans = Bimbingan::where('nama_dosen', $nama_dosen)
            ->where('tahun_awal', $tahun_awal)
            ->where('tahun_akhir', $tahun_akhir)
            ->where('semester', $semester)
            ->get();

        return view('lihat_hasil_Bimbingan_dosen_Kaprodi', compact('bimbingans', 'nama_dosen'));
    }


    public function showByDosenMahasiswa($nama_dosen)
    {
        // Ambil data mahasiswa yang sedang login berdasarkan email user yang sedang login
        $email = auth()->user()->email;
        $mahasiswa = Mahasiswa::where('email', $email)->first();

        if ($mahasiswa) {
            // Ambil data bimbingan hanya untuk mahasiswa yang sedang login dan untuk dosen yang sesuai
            $bimbingans = Bimbingan::where('nama_dosen', $nama_dosen)
                ->where('npm', $mahasiswa->npm) // Filter berdasarkan npm mahasiswa yang login
                ->where('tahun_awal', request()->query('tahun_awal'))  // Menambahkan filter tahun awal
                ->where('tahun_akhir', request()->query('tahun_akhir'))  // Menambahkan filter tahun akhir
                ->where('semester', request()->query('semester'))  // Menambahkan filter semester
                ->get();

            return view('lihat_hasil_Bimbingan_dosen_Mahasiswa', compact('bimbingans', 'nama_dosen'));
        }

        // Jika mahasiswa tidak ditemukan, arahkan ke halaman lain
        return redirect()->route('home')->with('error', 'Data mahasiswa tidak ditemukan!');
    }


    public function export(Request $request, $id)
    {
        // Ambil parameter tahun_awal, tahun_akhir, dan semester dari request
        $tahun_awal = $request->query('tahun_awal');
        $tahun_akhir = $request->query('tahun_akhir');
        $semester = $request->query('semester');

        // Ambil data bimbingan untuk satu mahasiswa berdasarkan NPM dan periode
        $bimbingan = Bimbingan::where('npm', $id)
            ->where('tahun_awal', $tahun_awal)
            ->where('tahun_akhir', $tahun_akhir)
            ->where('semester', $semester)
            ->get();

        // Cek jika tidak ada data
        if ($bimbingan->isEmpty()) {
            return redirect()->route('bimbingan.index')->with('error', 'Tidak ada data bimbingan untuk mahasiswa ini pada periode yang dipilih');
        }

        // Generate PDF
        $pdf = PDF::loadView('pdf.bimbingan', compact('bimbingan'));

        // Return download PDF
        return $pdf->download('hasil_bimbingan_' . $bimbingan->first()->nama_mahasiswa . '.pdf');
    }


    public function show($id)
    {
        // Mengambil data bimbingan berdasarkan ID
        $bimbingan = Bimbingan::findOrFail($id);

        // Mengembalikan tampilan dengan data bimbingan yang ditemukan
        return view('lihat_detail_bimbingan', compact('bimbingan'));
    }

    public function showKaprodi($id)
    {
        // Mengambil data bimbingan berdasarkan ID
        $bimbingan = Bimbingan::findOrFail($id);

        // Mengembalikan tampilan dengan data bimbingan yang ditemukan
        return view('lihat_detail_bimbingan_Kaprodi', compact('bimbingan'));
    }

    public function showMahasiswa($id)
    {
        // Mengambil data bimbingan berdasarkan ID
        $bimbingan = Bimbingan::findOrFail($id);

        // Mengembalikan tampilan dengan data bimbingan yang ditemukan
        return view('lihat_detail_bimbingan_Kaprodi_Mahasiswa', compact('bimbingan'));
    }

    public function getMahasiswaByNpm($npm)
    {
        $mahasiswa = Mahasiswa::where('npm', $npm)->first();

        if ($mahasiswa) {
            return response()->json([
                'success' => true,
                'mahasiswa' => [
                    'nama' => $mahasiswa->nama,
                    'angkatan' => $mahasiswa->angkatan,
                ],
            ]);
        }

        return response()->json(['success' => false]);
    }
}
