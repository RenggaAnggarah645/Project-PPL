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
        Schema::table('bimbingans', function (Blueprint $table) {
            $table->string('tahun_awal');
            $table->string('tahun_akhir');
            $table->enum('semester', ['ganjil', 'genap']);
        });
    }
    
    public function down()
    {
        Schema::table('bimbingans', function (Blueprint $table) {
            $table->dropColumn(['tahun_awal', 'tahun_akhir', 'semester']);
        });
    }
    
};
