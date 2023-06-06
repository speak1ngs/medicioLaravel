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
            $table->integer('importe');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('paciente_id')->nullable();
            $table->unsignedBigInteger('calendarios_deta_id')->nullable();
            $table->unsignedBigInteger('pago_id')->nullable();
            $table->unsignedBigInteger('medio_id')->nullable();


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

            $table->foreign('paciente_id')
            ->references('id')
            ->on('pacientes')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('calendarios_deta_id')
            ->references('id')
            ->on('calendarios_detalles')
            ->onDelete('cascade')
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
