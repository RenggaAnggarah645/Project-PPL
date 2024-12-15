<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class CRUDDosenImport implements ToModel
{
    public function model(array $row)
    {
        // Cek jika kolom email kosong atau tidak terdefinisi
        if (empty($row[2]) || !filter_var($row[2], FILTER_VALIDATE_EMAIL)) {
            return null; // Lewati baris jika email kosong atau tidak valid
        }

        // Cek apakah user dengan email ini sudah ada
        $existingUser = User::where('email', $row[2])->first();
        
        if (!$existingUser) {
            // Buat akun user baru
            $user = User::create([
                'name' => $row[0],
                'email' => $row[2],
                'password' => Hash::make($row[3]), // Password dari file Excel
                'role' => 'dosen', // Role dosen
            ]);

            // Buat data dosen terkait
            return new Dosen([
                'user_id' => $user->id,
                'name' => $row[0],
                'nip' => $row[1],
                'email' => $row[2],
            ]);
        }

        return null; // Jika email sudah ada, lewati data ini
    }
}
