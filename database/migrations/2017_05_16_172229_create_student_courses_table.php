<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCoursesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('student_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            //  nombre del ciclo formativo en ingles
            $table->integer('cicle_id')->unsigned();
            //  nombre de la tabla en ingles
            $table->foreign('cicle_id')->references('id')->on('cicles')->onDelete('cascade');
            // No puedes usar 2 timestamp
            //$table->dateTime("fecha_inicio");
            //$table->dateTime("fecha_fin");
            $table->string('promocion', 20);
            $table->boolean('finalizado')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('student_courses');
    }

}