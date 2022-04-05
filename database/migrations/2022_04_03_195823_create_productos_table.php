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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre",20);
            $table->string("descripción",100)->nullable();
            $table->float('precio',8,2);
            $table->string("imagen",100)->nullable();
            $table->tinyInteger("consecionado")->nullable();
            $table->string("motivo",100)->nullable();
            $table->integer("existencia")->nullable();
            $table->integer("pendientes")->nullable();

            $table->foreignId('usuarios_id')
            ->constrained('usuarios');
           

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
