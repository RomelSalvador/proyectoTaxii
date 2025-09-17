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
        Schema::create('ubicaciones_viaje', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('viaje_id');          // Relación con el viaje
            $table->decimal('lat', 10, 7);                   // Latitud
            $table->decimal('lng', 10, 7);                   // Longitud
            $table->decimal('velocidad', 10, 2)->nullable(); // Velocidad opcional
            $table->timestamp('registrado_en')->useCurrent(); // Momento de registro
            $table->timestamps();

            // Relación con viajes
            $table->foreign('viaje_id')
                ->references('id')
                ->on('viajes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicaciones_viaje');
    }
};
