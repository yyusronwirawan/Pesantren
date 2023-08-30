<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_nilai', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->string('nama');
            $table->string('pelajaran');
            $table->string('kelas');
            $table->string('tahun_ajar');
            $table->float('kehadiran')->nullable();
            $table->float('tugas')->nullable();
            $table->float('uts')->nullable();
            $table->float('uas')->nullable();
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
        Schema::dropIfExists('data_nilai');
    }
}
