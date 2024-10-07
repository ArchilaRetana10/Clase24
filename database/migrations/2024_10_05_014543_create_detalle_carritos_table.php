<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('detalle_carritos', function (Blueprint $table) {
            $table->bigIncrements('id'); // ID del detalle del carrito
            $table->unsignedBigInteger('carrito_id'); // ID del carrito
            $table->unsignedBigInteger('producto_id'); // ID del producto
            $table->integer('cantidad'); // Cantidad del producto en el carrito
            $table->decimal('precio', 10, 2); // Precio del producto en el carrito
            $table->timestamps();

            // Definir las relaciones con las tablas carritos y productos
            $table->foreign('carrito_id')->references('id')->on('carritos')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_carritos');
    }
};
