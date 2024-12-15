<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::create('data_mahasiswa_', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('npm')->unique();
            $table->string('angkatan');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('status')->default(1); // 1 = aktif, 0 = tidak aktif
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_mahasiswa_');
    }
}
