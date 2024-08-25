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
        //
        Schema::table('invoices', function (Blueprint $table){
            $table->softDeletes();
            $table->boolean('active')->default(true);
        });
        Schema::table('orders', function (Blueprint $table){
            $table->softDeletes();
            $table->boolean('active')->default(true);
        });
        Schema::table('cars', function (Blueprint $table){
            $table->softDeletes();
            $table->boolean('active')->default(true);
        });
        Schema::table('customers', function (Blueprint $table){
            $table->softDeletes();
            $table->boolean('active')->default(true);
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('invoices', function (Blueprint $table){
            $table->dropSoftDeletes();
            $table->dropColumn('active');
        });
        Schema::table('orders', function (Blueprint $table){
            $table->dropSoftDeletes();
            $table->dropColumn('active');
        });
        Schema::table('cars', function (Blueprint $table){
            $table->dropSoftDeletes();
            $table->dropColumn('active');
        });
        Schema::table('customers', function (Blueprint $table){
            $table->dropSoftDeletes();
            $table->dropColumn('active');
        });
    }
};
