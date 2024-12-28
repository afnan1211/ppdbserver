<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrangtuaTable extends Migration
{
    public function up()
    {
        Schema::create('tb_orangtua', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('jenis_orangtua', ['ayah', 'ibu']);
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->unsignedInteger('siswa_id');
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('tb_siswa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_orangtua');
    }
}
