<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'nip', 'email'
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model DataMahasiswa (Mahasiswa yang dibimbing oleh dosen)
     */
    public function mahasiswa()
    {
        return $this->hasMany(Dosen::class, 'dosen_pembimbing_id');
    }
    
    // Tentukan nama tabel yang sesuai dengan tabel di database
    protected $table = 'dosens';  // Sesuaikan dengan nama tabel di database Anda
}
