<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',60);
            $table->string('apellido',60);
            $table->string('cedula',15);
            $table->time('fecha_nacimiento')->nullable();
            $table->integer('telefono_particular')->nullable();
            $table->integer('edad')->nullable();
            $table->unsignedBigInteger('ciudad_id')->nullable();
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->unsignedBigInteger('barrio_id')->nullable();


            $table->foreign('ciudad_id')
            ->references('id')
            ->on('ciudades')
            ->onDelete('set null');

            $table->foreign('pais_id')
            ->references('id')
            ->on('paises')
            ->onDelete('set null');


            $table->foreign('barrio_id')
            ->references('id')
            ->on('barrios')
            ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
