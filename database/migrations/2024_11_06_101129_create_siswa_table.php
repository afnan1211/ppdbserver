<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    public function up()
    {
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique();
            $table->string('nama_lengkap')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nisn')->unique();
            $table->text('alamat_lengkap')->nullable();
            $table->string('sekolah_asal')->nullable();
            $table->text('alamat_sekolah_asal')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('nomor_registrasi')->unique();
            $table->unsignedInteger('ayah_id')->nullable();
            $table->unsignedInteger('ibu_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_siswa');
    }
}
