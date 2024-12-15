<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembimbingAkademik extends Model
{
    use HasFactory;

    protected $table = 'pembimbing_akademik';  // Nama tabel untuk pembimbing akademik

    protected $fillable = [
        'mahasiswa_id',
        'dosen_id',
    ];

    // Relasi dengan Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    // Relasi dengan Dosen
    public function dosen()
    {
        return $this->belongsTo(dosen::class, 'dosen_id');
    }
}
