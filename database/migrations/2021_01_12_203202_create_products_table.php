<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('tienda_id');
            $table->string('nombre');
            $table->string('img')->nullable();
            $table->string('descripcion')->nullable();
            $table->decimal('precio', 8, 2);
            $table->integer('stock')->default(0)->nullable();

            $table->foreign('tienda_id')->references('id')->on('tiendas');
            $table->foreign('categoria_id')->references('id')->on('categorias');


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
        Schema::dropIfExists('products');
    }
}
