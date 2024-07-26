<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('invoice', 100);
            $table->string('catatan', 255);
            $table->string('layanan', 50);
            $table->string('tujuan', 50);
            $table->string('mulai_sewa', 20);
            $table->string('selesai_sewa', 20);
            $table->smallInteger('lama_sewa');
            $table->integer('total_harga')->default(0);
            $table->integer('overtime')->default(0);
            $table->string('status');
            $table->string('snap_token');
            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
