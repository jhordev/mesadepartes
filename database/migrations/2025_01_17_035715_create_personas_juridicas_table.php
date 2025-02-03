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
        Schema::create('personas_juridicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_Expediente')->constrained('expedientes', 'ID_Expediente')->onDelete('cascade');
            $table->string('RUC', 11);
            $table->string('Nombre_Entidad', 150);
            $table->string('Departamento', 50)->nullable();
            $table->string('Provincia', 50)->nullable();
            $table->string('Distrito', 50)->nullable();
            $table->text('Direccion')->nullable();
            $table->foreignId('ID_Representante')->constrained('representantes_legales', 'ID')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas_juridicas');
    }
};
