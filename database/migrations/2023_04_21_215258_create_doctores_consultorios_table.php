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
        Schema::create('doctores_consultorios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('consultorio_id');
            $table->unsignedBigInteger('doctor_id');

            $table->foreign('consultorio_id')
            ->references('id')
            ->on('consultorios')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('doctor_id')
            ->references('id')
            ->on('doctores')
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
        Schema::dropIfExists('doctores_consultorios');
    }
};
