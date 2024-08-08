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
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('no_invoice');
            $table->string('driver');
            $table->string('user');
            $table->string('tanggal');
            $table->integer('uang_makan')->default(0);
            $table->integer('penginapan')->default(0);
            $table->integer('bbm')->default(0);
            $table->integer('tol')->default(0);
            $table->integer('parkir')->default(0);
            $table->integer('steam')->default(0);
            $table->integer('nitrogen')->default(0);
            $table->bigInteger('harga_invoice')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
