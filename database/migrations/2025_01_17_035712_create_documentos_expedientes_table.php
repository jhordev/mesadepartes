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
        Schema::create('documentos_expedientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_Expediente')->constrained('expedientes', 'ID_Expediente')->onDelete('cascade');
            $table->string('Nombre_Documento', 255);
            $table->text('Link_Documento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_expedientes');
    }
};
