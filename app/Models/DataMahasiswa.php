<?php

// Model DataMahasiswa
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'data_mahasiswa_';

    protected $fillable = [
        'nama_lengkap',
        'npm',
        'angkatan',
        'email',
        'password',
        'status',
        'dosen_pembimbing_id', // Tambahkan kolom dosen_pembimbing_id agar dapat disertakan dalam fillable
    ];

    protected $hidden = ['password'];

    // Relasi dengan DataDosen
    public function dosen_pembimbing()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_id');
    }
}

