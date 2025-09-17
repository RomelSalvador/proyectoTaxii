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
        Schema::create('bitacora', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->nullable(); // Usuario que realizó la acción
            $table->string('accion', 150);                        // Acción realizada (ej: "Creó un viaje", "Reportó incidente")
            $table->string('recurso_tipo', 100)->nullable();      // Tipo de recurso afectado (ej: Usuario, Viaje, Incidente)
            $table->unsignedBigInteger('recurso_id')->nullable(); // ID del recurso afectado
            $table->string('ip', 50)->nullable();                 // IP desde donde se hizo la acción
            $table->text('agente_usuario')->nullable();           // Info del navegador o app usada
            $table->json('metadatos')->nullable();                // Datos adicionales en JSON
            $table->timestamps();

            // Relación con usuarios
            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuarios')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacora');
    }
};
