<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJumlahSiswaToGenerations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generations', function (Blueprint $table) {
            $table->integer('jumlah_siswa');
            $table->integer('belum_memilih');
            $table->integer('sudah_memilih');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generations', function (Blueprint $table) {
            $table->drop('jumlah_siswa');
            $table->drop('belum_memilih');
            $table->drop('sudah_memilih');
        });
    }
}
