<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestasiSantriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestasi_santri', function (Blueprint $table) {
            $table->increments('id');
            $table->String('nis');
            $table->String('nama');
            $table->foreignId('prestasi_id');
            $table->String('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestasi_santri');
    }
}
