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
        Schema::create('incidentes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('viaje_id')->nullable();    // Relación con viaje (si aplica)
            $table->unsignedBigInteger('reportante_id');           // Usuario que reporta el incidente
            $table->string('tipo', 100);                           // Tipo de incidente (ej: robo, acoso, falla técnica)
            $table->text('descripcion')->nullable();               // Descripción detallada
            $table->enum('gravedad', ['baja', 'media', 'alta'])->default('media'); // Nivel de gravedad
            $table->string('evidencia_ruta', 255)->nullable();     // Ruta de archivo (foto/video)
            $table->enum('estado', ['abierto', 'investigacion', 'cerrado'])->default('abierto'); // Estado del incidente

            $table->timestamps();

            // Relaciones
            $table->foreign('viaje_id')
                ->references('id')
                ->on('viajes')
                ->onDelete('set null');

            $table->foreign('reportante_id')
                ->references('id')
                ->on('usuarios')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidentes');
    }
};
