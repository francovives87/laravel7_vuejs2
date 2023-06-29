<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('tienda_id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('pais');
            $table->string('direccion');
            $table->string('apartamento')->nullable();
            $table->string('ciudad');
            $table->string('provincia');
            $table->string('codigo_postal');
            $table->string("telefono");
            $table->string('email');
            $table->text('notas');
            $table->string('metodo_pago');
            $table->string('estado')->default('en espera');
            $table->string('total');
            $table->foreign('tienda_id')->references('id')->on('tiendas')->onDelete('cascade');
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
