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
        Schema::create('pagos', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('orden_id'); 
            $table->decimal('monto', 10, 2); 
            $table->string('metodo_pago'); 
            $table->timestamps();

            $table->foreign('orden_id')->references('id')->on('ordenes')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
