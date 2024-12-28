<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengumumanTable extends Migration
{
    public function up()
    {
        Schema::create('tb_pengumuman', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('judul');
            $table->text('isi');
            $table->date('tanggal_dibuat');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_pengumuman');
    }
}
