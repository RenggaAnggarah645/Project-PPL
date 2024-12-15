<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CRUDMahasiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        ini_set('max_execution_time', 300); // Set batas waktu eksekusi

        $password = Hash::make($row['password'], ['rounds' => 10]); // Atur cost sesuai default

        // Buat user baru
        $user = User::create([
            'name' => $row['nama'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']), // Password yang di-hash
            'role' => 'mahasiswa',
        ]);

        // Buat mahasiswa baru
        return new Mahasiswa([
            'user_id' => $user->id,
            'nama' => $row['nama'],
            'npm' => $row['npm'],
            'angkatan' => $row['angkatan'],
            'email' => $row['email'],
        ]);
    }
}
