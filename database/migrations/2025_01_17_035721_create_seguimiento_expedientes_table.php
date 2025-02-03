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
        Schema::create('seguimiento_expedientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_Expediente')->constrained('expedientes', 'ID_Expediente')->onDelete('cascade');
            $table->foreignId('ID_Area_Origen')->nullable()->constrained('areas', 'ID_Area')->onDelete('set null');
            $table->foreignId('ID_Area_Destino')->nullable()->constrained('areas', 'ID_Area')->onDelete('set null');
            $table->foreignId('ID_Usuario_Responsable')->nullable()->constrained('usuarios', 'ID_Usuario')->onDelete('set null');
            $table->text('Mensaje')->nullable();
            $table->text('Documento_Adjunto')->nullable();
            $table->enum('Estado', ['Pendiente', 'En Tramite', 'Atendido']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimiento_expedientes');
    }
};
