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
        Schema::create('usuarios_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_Usuario')->constrained('usuarios', 'ID_Usuario')->onDelete('cascade');
            $table->foreignId('ID_Area')->constrained('areas', 'ID_Area')->onDelete('cascade');
            $table->unique(['ID_Usuario', 'ID_Area']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios_areas');
    }
};
