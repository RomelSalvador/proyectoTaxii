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
        Schema::create('capacitaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conductor_id');       // Conductor al que pertenece la capacitación
            $table->string('nombre', 150);                    // Nombre de la capacitación 
            $table->text('descripcion')->nullable();          // Descripción del curso
            $table->date('fecha_inicio')->nullable();         // Fecha de inicio de la capacitación
            $table->date('fecha_fin')->nullable();            // Fecha de finalización
            $table->string('institucion', 150)->nullable();   // Institución que brindó la capacitación
            $table->string('certificado_ruta', 255)->nullable(); // Ruta al archivo del certificado (PDF/imagen)
            $table->timestamps();

            // Relación con conductores
            $table->foreign('conductor_id')
                ->references('id')
                ->on('conductores')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacitaciones');
    }
};
