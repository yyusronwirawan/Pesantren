<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username');
            $table->string('level');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('kelas')->nullable();
            $table->string('foto')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('tahun_ajar')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('no_hp')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
