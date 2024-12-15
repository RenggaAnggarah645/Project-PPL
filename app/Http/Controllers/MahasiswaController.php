<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Mendapatkan data mahasiswa berdasarkan user yang sedang login
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->first(); // Ambil data mahasiswa berdasarkan user_id

        // Menampilkan halaman dashboard mahasiswa dengan data mahasiswa
        return view('dashboard-mahasiswa', compact('mahasiswa'));
    }
}

