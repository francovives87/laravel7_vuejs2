<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nombre');
            $table->string('categoria');
            $table->text('descripcion');
            $table->string('imagen')->default('/shop-2607121_640.jpg');
            $table->string('pais')->nullable();
            $table->string('region')->nullable();
            $table->string('subregion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('direccion')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('barrio')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('telefono')->nullable();
            $table->string('horarios')->nullable();
            $table->integer('plan')->default(1);
            $table->integer('plantilla')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiendas');
    }
}
