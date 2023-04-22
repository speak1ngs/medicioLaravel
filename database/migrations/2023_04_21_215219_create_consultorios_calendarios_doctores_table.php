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
        Schema::create('consultorios_calendarios_doctores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('consultorio_id');
            $table->unsignedBigInteger('calendario_doctor_id');

            $table->foreign('consultorio_id')
            ->references('id')
            ->on('consultorios')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('calendario_doctor_id')
            ->references('id')
            ->on('calendarios_doctores')
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
        Schema::dropIfExists('consultorios_calendarios_doctores');
    }
};
