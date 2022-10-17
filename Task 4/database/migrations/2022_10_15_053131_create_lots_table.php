<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->String("company");
            $table->String("email")->nullable();
            $table->String("mobile")->nullable();
            $table->String("lot_name")->unique();
            $table->String("product_name");
            $table->String("weight");
            $table->String("country");
            $table->String("harvest_date");
            $table->String("expiry_date");
            $table->String("status");
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
        Schema::dropIfExists('lots');
    }
}
