<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataDosenTable extends Migration // Ganti CreateDataKaprodiTable menjadi CreateDataDosenTable
{
    public function up()
    {
        Schema::create('data_dosen', function (Blueprint $table) { // Ganti nama tabel menjadi data_dosen
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nip')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('status')->default(1); // 1 = aktif, 0 = tidak aktif
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_dosen'); // Ganti nama tabel saat menghapus
    }
}
