<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenTable extends Migration
{
    public function up()
    {
        Schema::create('tb_dokumen', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('jenis_dokumen', ['akta_kelahiran', 'kartu_keluarga', 'ijazah_sekolah', 'foto_diri']);
            $table->string('path_dokumen');
            $table->unsignedInteger('siswa_id');
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('tb_siswa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_dokumen');
    }
}
