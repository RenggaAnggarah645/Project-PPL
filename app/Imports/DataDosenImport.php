<?php

namespace App\Imports;

use App\Models\DataDosen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // Jika Excel memiliki header
use Illuminate\Support\Facades\Log;

class DataDosenImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Validasi jika kolom yang diperlukan kosong
        if (empty($row['nama_lengkap']) || empty($row['nip']) || empty($row['email'])) {
            // Log peringatan jika ada data yang kosong
            Log::warning('Data invalid: ', $row);
            return null; // Abaikan baris ini jika ada data yang kosong
        }

        return new DataDosen([
            'nama_lengkap' => $row['nama_lengkap'], // Sesuaikan dengan nama kolom di Excel
            'nip' => $row['nip'],
            'email' => $row['email'],
            'password' => ($row['password'] ?? 'defaultpassword'),  // Menambahkan password, dengan default jika kosong
        ]);
    }
}
