<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('estado')->nullable();
            $table->string('ref')->nullable();

            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('tel')->nullable();
            $table->string('correo')->nullable();
            $table->string('cedula')->nullable();

            $table->string('tiempo')->nullable();
            $table->string('oracional')->nullable();
            $table->string('municipio')->nullable();
            $table->string('direccion')->nullable();
            $table->string('valor')->nullable();

            $table->integer('titular_id')->unsigned()->nullable();
            $table->foreign('titular_id')
                  ->references('id')
                  ->on('titulars')
                  ->onDelete('cascade');

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
        Schema::dropIfExists('ordens');
    }
}
