<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            //$table->timestamps();
            $table->string("correo",100)->nullable();
            $table->float('monto',8,2);
            $table->enum('status', ['Aceptado','Rechazado'])->default('Rechazado');
            $table->enum('tipo', ['Transacción','Deposito'])->default('Transacción');
            $table->string("evidencia",150)->nullable();

            $table->foreignId('productos_id')->nullable()
            ->constrained('productos')->onUpdate('cascade') ->onDelete('cascade');
           

        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};