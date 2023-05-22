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
        Schema::create('calendarios_doctores', function (Blueprint $table) {
            $table->id();
            $table->time('horario_inicio');
            $table->time('horario_fin');
            $table->integer('costo_consulta');
            $table->string('dias');
            $table->unsignedBigInteger('doctores_id')->nullable();
            $table->unsignedBigInteger('consultorios_id')->nullable();
    


            $table->foreign('doctores_id')
            ->references('id')
            ->on('doctores')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('consultorios_id')
            ->references('id')
            ->on('consultorios')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendarios_doctores');
    }
};
