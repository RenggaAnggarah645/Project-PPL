<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKaprodi extends Model
{
    use HasFactory;

    protected $table = 'data_kaprodi';

    protected $fillable = [
        'nama_lengkap',
        'nip',
        'email',
        'password',
        'status',
    ];

    protected $hidden = ['password'];
}
