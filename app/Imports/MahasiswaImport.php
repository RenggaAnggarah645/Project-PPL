<?php

namespace App\Imports;

use App\Models\DataMahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class MahasiswaImport implements ToModel
{
    public function model(array $row)
    {
        return new DataMahasiswa([
            'nama_lengkap' => $row[0],
            'npm' => $row[1],
            'angkatan' => $row[2],
            'email' => $row[3],
            'password' => ($row[4]), // Menggunakan bcrypt untuk password
            'status' => 1, // Atur status default
        ]);
    }
}
