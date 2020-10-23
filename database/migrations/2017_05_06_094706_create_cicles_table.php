<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cicles', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('family_id')->unsigned(); //FK
            $table->enum('tipo',['CFGS','CFGM','FPB']);
            $table->enum('plan',['LOE','LOGSE','LOMCE']);
            $table->string('name');
            $table->timestamps();    //Añade create_at y update_at

            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::drop('cicles');
    }
}
