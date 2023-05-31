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
        Schema::create('citas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nro_operacion_pago',100);
            $table->date('fecha_reservada');
            $table->integer('importe');
            $table->time('horario_reserva');
            $table->unsignedBigInteger('calendario_doctore_id');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('pago_id')->nullable();
            $table->unsignedBigInteger('medio_id')->nullable();
            
            $table->foreign('calendario_doctore_id')
            ->references('id')
            ->on('calendarios_doctores')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('status_id')
            ->references('id')
            ->on('citas_status')
            ->onDelete('set null')
            ->onUpdate('cascade');
            
            $table->foreign('pago_id')
            ->references('id')
            ->on('pagos_stats')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->foreign('medio_id')
            ->references('id')
            ->on('medios_pagos')
            ->onDelete('set null')
            ->onUpdate('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
