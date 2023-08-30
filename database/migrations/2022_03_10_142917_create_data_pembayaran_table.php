<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pembayaran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nis');
            $table->string('tagihan');
            $table->string('bulan');
            $table->string('tahun');
            $table->String('status');
            $table->String('transaction_id')->nullable();
            $table->String('order_id')->nullable();
            $table->String('gross_amount');
            $table->String('payment_type');
            $table->String('store')->nullable();
            $table->String('bank')->nullable();
            $table->String('payment_code')->nullable();
            $table->String('kode_bank')->nullable();
            $table->String('bill_key')->nullable();
            $table->String('va_number')->nullable();
            $table->String('pdf_url')->nullable();

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
        Schema::dropIfExists('data_pembayaran');
    }
}
