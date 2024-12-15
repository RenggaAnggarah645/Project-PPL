<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_dosen',
        'nip',
        'nama_mahasiswa',
        'npm',
        'tanggal_bimbingan',
        'topik_pembahasan',
        'uraian_pembahasan',
        'angkatan',
        'tahun_awal',
        'tahun_akhir', 
        'semester',
    ];
}
