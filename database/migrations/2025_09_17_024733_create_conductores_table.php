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
        Schema::create('conductores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->unique(); // Relación 1:1 con usuarios
            $table->string('dni', 15)->nullable(); // Documento de identidad
            $table->string('licencia_numero', 30)->nullable(); // N de licencia
            $table->date('licencia_vencimiento')->nullable(); // Fecha de vencimiento
            $table->string('placa_vehiculo', 20)->nullable(); // Placa del vehículo
            $table->string('modelo_vehiculo', 100)->nullable(); // Modelo del vehículo
            $table->boolean('verificado')->default(false); // Conductor validado por admin
            $table->timestamp('fecha_verificacion')->nullable(); // Cuándo se verificó
            $table->json('documentos')->nullable(); // Archivos JSON (licencia escaneada, SOAT, etc.)
            $table->timestamps();

            // Clave foránea hacia usuarios
            $table->foreign('usuario_id')
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
        Schema::dropIfExists('conductores');
    }
};
