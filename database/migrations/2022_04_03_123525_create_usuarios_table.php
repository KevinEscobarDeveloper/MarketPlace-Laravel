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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string("nombre",50);
            $table->string("apellido_paterno",30)->nullable();
            $table->string("apellido_materno",30)->nullable();
            $table->string("correo",50);
            $table->string("imagen",30)->nullable();
            $table->enum('rol', ['Cliente','Encargado','Contador','Vendedor'])->default('Cliente');
            $table->tinyInteger("activo");
            $table->string("password",100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
