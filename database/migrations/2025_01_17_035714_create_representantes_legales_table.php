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
        Schema::create('representantes_legales', function (Blueprint $table) {
            $table->id();
            $table->string('Tipo_Documento', 50);
            $table->string('Numero_Documento', 20);
            $table->string('Nombre', 100);
            $table->string('Apellido_Paterno', 100);
            $table->string('Apellido_Materno', 100)->nullable();
            $table->string('Email', 100)->nullable();
            $table->string('Telefono', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representantes_legales');
    }
};
