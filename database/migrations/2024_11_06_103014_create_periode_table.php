<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodeTable extends Migration
{
    public function up()
    {
        Schema::create('tb_periode', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_periode');
            $table->boolean('status')->default(0);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_periode');
    }
}
