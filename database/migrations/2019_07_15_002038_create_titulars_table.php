<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTitularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titulars', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('tel')->nullable();
            $table->string('correo')->nullable();
            $table->string('cedula')->nullable();
           
           
            
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
        Schema::dropIfExists('titulars');
    }
}
