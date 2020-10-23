<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTeachers extends Migration
{
    public function up() {
        Schema::create('teachers', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned(); //FK
            $table->string('apellidos');
            $table->string('nrp_expediente');
            $table->boolean('is_admin');
            $table->timestamps();    //Añade create_at y update_at
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
        });
    }
    public function down() {
        Schema::drop('teachers');
    }
}
