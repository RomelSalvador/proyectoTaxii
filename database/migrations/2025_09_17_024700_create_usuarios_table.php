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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('correo', 100)->unique();
            $table->string('telefono', 20)->nullable();
            $table->string('contrasena', 255); 
            $table->unsignedBigInteger('rol_id'); 
            $table->boolean('activo')->default(true);
            $table->timestamp('correo_verificado_en')->nullable();
            $table->timestamps();

            // Clave foránea hacia roles
            $table->foreign('rol_id')
                ->references('id')
                ->on('roles')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
