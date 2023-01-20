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
        Schema::table('bid_creation__creations', function (Blueprint $table) {

            $table -> bigInteger("tendercreation")->unsigned()->after('location');
            $table -> foreign("tendercreation")->references("id")->on("tender_creations")->onDelete("cascade")->onUpdate("NO ACTION");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bid_creation__creations', function (Blueprint $table) {
            //
        });
    }
};
