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
        Schema::create('bid_management_work_order_work_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bidid')->unsigned();
            $table->foreign('bidid')->references('id')->on('bid_creation__creations')->OnDelete('cascade')->onUpdate("NO ACTION");
            $table -> string('ProPeriod')->default(''); 
            $table->string('orderQuantity');
            $table->string('PricePerUnit');
            $table->string('LoaDate');
            $table->string('OrderDate');
            $table->string('AgreeDate');
            $table->string('SiteHandOverDate');
            $table->string('filepath_I');
            $table->string('filetype_I');
            $table->string('filepath_II');
            $table->string('filetype_II');
            $table->string('filepath_III');
            $table->string('filetype_III');
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
        Schema::dropIfExists('bid_management_work_order_work_orders');
    }
};
