<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('bimbingans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_dosen');
        $table->string('nip');
        $table->string('nama_mahasiswa');
        $table->string('npm');
        $table->date('tanggal_bimbingan');
        $table->string('topik_pembahasan');
        $table->text('uraian_pembahasan');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingans');
    }
};