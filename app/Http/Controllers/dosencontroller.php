<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    // Menampilkan halaman dashboard dosen berdasarkan akun yang sedang login
    public function index()
    {
        // Mendapatkan data dosen berdasarkan user yang sedang login
        $dosen = Auth::user()->dosen; // Pastikan relasi sudah ada di model User

        return view('dashboard-dosen-pa', compact('dosen'));
    }
}
