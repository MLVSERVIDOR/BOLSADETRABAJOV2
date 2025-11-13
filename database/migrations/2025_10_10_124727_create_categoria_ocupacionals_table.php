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
        Schema::create('categoria_ocupacionals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('sub_nombre')->nullable();
            $table->integer('vacantes')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('icono')->nullable();
            $table->string('estado')->default('1'); // 1: activo, 0: inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_ocupacionals');
    }
};
