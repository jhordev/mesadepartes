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
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id('ID_Expediente');
            $table->string('Numero_Expediente', 50)->unique();
            $table->string('Clave', 20);
            $table->enum('Tipo_Solicitante', ['Natural', 'Juridica']);
            $table->string('Asunto', 255);
            $table->text('Descripcion')->nullable();
            $table->enum('Estado', ['Pendiente', 'En Tramite', 'Atendido'])->default('Pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedientes');
    }
};
