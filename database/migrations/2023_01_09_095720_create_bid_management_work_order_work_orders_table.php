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
            $table->string('orderQuantity');
            $table->string('PricePerUnit');
            $table->date('LoaDate');
            $table->date('OrderDate');
            $table->date('AgreeDate');
            $table->date('SiteHandOverDate');
            $table->string('filetype_I');
            $table->string('filetype_II');
            $table->string('filetype_III');
            $table->string('createdby_userid');
            $table->string('updatedby_userid');
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
