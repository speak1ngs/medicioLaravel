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
        Schema::create('doctores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('registro');
            $table->string('foto_url',200);
            $table->integer('telefono_laboral');
            $table->date('registro_expericacion_fecha')->nullable();
            $table->text('descripcion')->nullable();
            $table->double('calificacion',0,1);
            $table->string('especialidades')->nullable();
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
        Schema::dropIfExists('doctores');
    }
};
