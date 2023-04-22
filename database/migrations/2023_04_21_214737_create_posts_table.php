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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo',45);
            $table->text('body');
            $table->string('extract',45);
            $table->string('slug',45);
            $table->string('foto_url')->nullable();
            $table->string('tags')->nullable();
            
            $table->unsignedBigInteger('user_id')->nullable();
        

            $table->foreign('user_id')
                    ->references('id')
                    ->on('posts_stats')
                    ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
