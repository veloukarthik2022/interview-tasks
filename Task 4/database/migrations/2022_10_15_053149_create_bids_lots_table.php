<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids_lots', function (Blueprint $table) {
            $table->id();
            $table->String("customer");
            $table->String("email")->nullable();
            $table->String("mobile")->nullable();
            $table->String("lot_id");
            $table->String("price");
            $table->String("bid_date");
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
        Schema::dropIfExists('bids_lots');
    }
}
