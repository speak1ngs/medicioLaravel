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
        Schema::create('calendarios_detalles', function (Blueprint $table) {
            $table->id();
            $table->date('dias_laborales');
            $table->time('horarios');
            $table->unsignedBigInteger('calendarios_doctores_id');
            $table->unsignedBigInteger('stat_id');
            $table->timestamps();


            $table->foreign('calendarios_doctores_id')
            ->references('id')
            ->on('calendarios_doctores')
            ->onDelete('cascade');

            $table->foreign('stat_id')
            ->references('id')
            ->on('status')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendarios_detalles');
    }
};
