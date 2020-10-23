<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
            $table->string('apellidos');
            $table->unsignedInteger('nre');
            $table->boolean('vehiculo')->default(0);
            $table->mediumText('domicilio');
            $table->enum('status', ['ESTUDIANDO', 'FCT', 'CONTRATADO', 'PARO'])->default("ESTUDIANDO");
            $table->unsignedTinyInteger('edad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('students');
    }

}
