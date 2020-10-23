<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEnterprises extends Migration
{
    public function up() {
        Schema::create('enterprises', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned(); //FK
            $table->text('descripcion')->nullable();
            $table->enum('sociedad',['SL','SA','SAE','SLNE', 'AUT'])->default('SL');
            $table->string('cif');
            $table->string('fax')->nullable();
            $table->date('fecha_fundacion')->nullable();
            $table->string('web')->nullable();
            $table->string('pais');
            $table->string('ciudad');
            $table->double('score')->default('0.00');
            $table->integer('min_empleados')->nullable();
            $table->integer('max_empleados')->nullable();
            $table->timestamps();    //Añade create_at y update_at

            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::drop('enterprises');
    }
}
