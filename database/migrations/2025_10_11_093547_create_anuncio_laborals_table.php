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
        Schema::create('anuncio_laborals', function (Blueprint $table) {
            $table->id();
            $table->string('id_users');
            $table->string('puesto');
            $table->string('id_categoria_ocupacionals')->nullable();
            $table->string('id_modalidads')->nullable();
            $table->integer('vacantes')->default(0);
            $table->decimal('sueldo', 10, 2)->default(0);
            $table->date('fecha_limite')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('condiciones')->nullable();
            $table->string('id_etapa')->default('1');
            
            // 🔹 NUEVA COLUMNA
            $table->text('motivo_rechazo')->nullable();

            $table->string('estado')->default('1'); // activo o inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anuncio_laborals');
    }
};
