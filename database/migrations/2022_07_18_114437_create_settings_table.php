<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aplikasi');
            $table->string('nama_pesantren');
            $table->string('alamat');
            $table->string('telp');
            $table->string('website');
            $table->string('pengasuh');
            $table->string('izin');
            $table->string('logo_aplikasi');
            $table->string('maintenance');
            $table->string('nominal_syariyyah');
            $table->string('nominal_daftarulang');
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
        Schema::dropIfExists('settings');
    }
}
