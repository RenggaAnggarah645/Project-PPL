<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relasi dengan model Kaprodi
     */
    public function kaprodi()
    {
        return $this->hasOne(Kaprodi::class);
    }
    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }
}
