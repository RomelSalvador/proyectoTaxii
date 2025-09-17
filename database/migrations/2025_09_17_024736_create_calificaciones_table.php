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
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('viaje_id')->nullable();     // Viaje relacionado
            $table->unsignedBigInteger('evaluador_id');             // Usuario que califica
            $table->unsignedBigInteger('evaluado_id');              // Usuario calificado
            $table->tinyInteger('estrellas')->unsigned();           // Puntuación 1 a 5
            $table->text('comentario')->nullable();                 // Comentario opcional

            $table->timestamps();

            // Relaciones
            $table->foreign('viaje_id')
                ->references('id')
                ->on('viajes')
                ->onDelete('set null');

            $table->foreign('evaluador_id')
                ->references('id')
                ->on('usuarios')
                ->onDelete('cascade');

            $table->foreign('evaluado_id')
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
        Schema::dropIfExists('calificaciones');
    }
};
