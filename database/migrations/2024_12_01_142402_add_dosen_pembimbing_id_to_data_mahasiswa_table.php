<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDosenPembimbingIdToDataMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::table('data_mahasiswa_', function (Blueprint $table) {
            $table->unsignedBigInteger('dosen_pembimbing_id')->nullable();  // Menambahkan kolom dosen_pembimbing_id
            $table->foreign('dosen_pembimbing_id')->references('id')->on('dosens')->onDelete('set null'); // Menambahkan foreign key untuk dosen
        });
    }

    public function down()
    {
        Schema::table('data_mahasiswa_', function (Blueprint $table) {
            $table->dropForeign(['dosen_pembimbing_id']);  // Menghapus foreign key
            $table->dropColumn('dosen_pembimbing_id');  // Menghapus kolom dosen_pembimbing_id
        });
    }
}
