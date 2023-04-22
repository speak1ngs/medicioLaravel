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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('foto_url',200);
            $table->double('calificacion',0,1);
            $table->integer('cantidad_consultas_reservadas')->nullable();
            $table->integer('cantidad_consultas_canceladas')->nullable();
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('stat_id');


            $table->foreign('persona_id')
            ->references('id')
            ->on('personas')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->foreign('stat_id')
            ->references('id')
            ->on('status')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
