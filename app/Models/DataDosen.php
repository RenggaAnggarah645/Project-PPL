<?php

// Model DataDosen
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDosen extends Model
{
    use HasFactory;

    protected $table = 'data_dosen';

    protected $fillable = [
        'nama_lengkap',
        'nip',
        'email',
        'password',
        'status',
    ];

    protected $hidden = ['password'];

    // Relasi dengan DataMahasiswa
    public function mahasiswa()
    {
        return $this->hasMany(DataMahasiswa::class, 'dosen_pembimbing_id');
    }
}

