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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Tipo de usuario (opcional)
            $table->string('id_roles')->nullable();

            // Datos Empresa (opcional)
            $table->string('nro_ruc')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('direccion_empresa')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('url_logo')->nullable();

            // Datos Persona
            $table->string('nombres')->nullable();
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->string('nro_documento')->unique()->nullable();
            $table->string('fecha_nacimiento')->nullable();
            $table->string('celular')->nullable();
            $table->string('curriculum_vitae')->nullable();

            // Credenciales
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Estado
            $table->string('id_estado')->default('1'); // activo o inactivo
            $table->string('id_tipo_documentos')->nullable();

            $table->rememberToken();
            $table->timestamps(6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
