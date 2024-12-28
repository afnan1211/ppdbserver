<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranTable extends Migration
{
    public function up()
    {
        Schema::create('tb_pendaftaran', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('siswa_id');
            $table->date('tanggal_daftar');
            $table->enum('status', ['ditunda', 'terdaftar', 'lulus', 'tidak_lulus']);
            $table->unsignedInteger('periode_id');
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('tb_siswa')->onDelete('cascade');
            $table->foreign('periode_id')->references('id')->on('tb_periode')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_pendaftaran');
    }
}
