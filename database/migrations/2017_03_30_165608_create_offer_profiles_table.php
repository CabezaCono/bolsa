<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_offer');
            //$table->foreign('id_offer')
              //  ->references('id')->on('offers')->onDelete('cascade');
            $table->integer('id_cycle_profile');
            //$table->foreign('id_cycle_profile')
              //  ->references('id')->on('cycle_profiles')->onDelete('cascade');
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
        Schema::dropIfExists('offer_profiles');
    }
}
