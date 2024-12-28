<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianTable extends Migration
{
    public function up()
    {
        Schema::create('tb_ujian', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('siswa_id');
            $table->decimal('nilai', 5, 2)->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('tb_siswa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_ujian');
    }
}
