<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaprodiController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Ambil data kaprodi terkait dengan user yang login
        $kaprodi = $user->kaprodi;  // Karena ada relasi user -> kaprodi

        return view('dashboard-kaprodi', compact('kaprodi'));
    }
}
