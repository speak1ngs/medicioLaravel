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
        Schema::create('consultorios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',100);
            $table->string('social_instagram',60)->nullable();
            $table->string('social_facebook',60)->nullable();
            $table->string('social_twitter',60)->nullable();
            $table->string('social_web_site',100)->nullable();
            $table->string('ruc',15)->nullable();
            $table->string('map',200)->nullable();
            $table->integer('telefono');
            $table->integer('intervalo_consulta');
            $table->string('foto_url',200)->nullable();
            $table->string('latitud',60)->nullable();
            $table->string('longitud',60)->nullable();
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->unsignedBigInteger('ciudad_id')->nullable();
            $table->unsignedBigInteger('calle_principal_id')->nullable();
            $table->unsignedBigInteger('calle_secundaria_id')->nullable();
            $table->unsignedBigInteger('calle_terciaria_id')->nullable();
            $table->unsignedBigInteger('barrio_id')->nullable();
            $table->unsignedBigInteger('stat_id')->nullable();


            $table->foreign('calle_principal_id')
            ->references('id')
            ->on('calles')
            ->onDelete('set null')
            ->onUpdate('cascade');


            $table->foreign('calle_secundaria_id')
            ->references('id')
            ->on('calles')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->foreign('calle_terciaria_id')
            ->references('id')
            ->on('calles')
            ->onDelete('set null')
            ->onUpdate('cascade');


            $table->foreign('barrio_id')
            ->references('id')
            ->on('barrios')
            ->onDelete('set null')
            ->onUpdate('cascade');


            $table->foreign('pais_id')
            ->references('id')
            ->on('paises')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->foreign('ciudad_id')
            ->references('id')
            ->on('ciudades')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->foreign('stat_id')
            ->references('id')
            ->on('status')
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
        Schema::dropIfExists('consultorios');
    }
};
