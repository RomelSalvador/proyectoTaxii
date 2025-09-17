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
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasajero_id');   // Usuario pasajero
            $table->unsignedBigInteger('conductor_id')->nullable(); // Usuario conductor (puede asignarse luego)

            // Coordenadas de origen y destino
            $table->decimal('origen_lat', 10, 7);
            $table->decimal('origen_lng', 10, 7);
            $table->decimal('destino_lat', 10, 7)->nullable();
            $table->decimal('destino_lng', 10, 7)->nullable();

            // Direcciones legibles
            $table->string('direccion_origen', 255)->nullable();
            $table->string('direccion_destino', 255)->nullable();

            // Estado del viaje
            $table->enum('estado', [
                'solicitado',
                'asignado',
                'en_progreso',
                'completado',
                'cancelado'
            ])->default('solicitado');

            $table->timestamp('inicio_en')->nullable(); // Inicio del viaje
            $table->timestamp('fin_en')->nullable();    // Fin del viaje

            $table->timestamps();

            // Relaciones
            $table->foreign('pasajero_id')
                ->references('id')
                ->on('usuarios')
                ->onDelete('cascade');

            $table->foreign('conductor_id')
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
        Schema::dropIfExists('viajes');
    }
};
