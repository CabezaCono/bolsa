<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enterprise_id')->unsigned();
            $table->foreign('enterprise_id')->references('id')->on('enterprises')->onDelete('cascade');
            $table->integer('family_id')->unsigned();
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->text('requirements')->nullable();
            $table->text('recommended')->nullable();
            $table->text('description');
            $table->string('title', 255);
            $table->enum('work_day',['full day','half day']);
            $table->string('schedule',255);
            $table->enum('contract',['FCT','Practice','Temporay','Indefinite']);
            $table->integer('salary');
            $table->enum('status',['Pend_Validacion','Pend_Confirmacion','Pausada','Finalizada','Denegada']);
            $table->integer('student_number');
            $table->date('start_date');
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
