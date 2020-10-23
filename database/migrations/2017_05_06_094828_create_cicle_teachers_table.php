<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCicleTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cicle_teachers', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('teacher_id')->unsigned(); //FK
            $table->integer('cicle_id')->unsigned(); //FK
            $table->string('promocion');
            $table->timestamps();    //Añade create_at y update_at

            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('cicle_id')->references('id')->on('cicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cicle_teachers');
    }
}
