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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // Nombre del cliente
            $table->string('last_name'); // Apellidos del cliente
            $table->string('document_number')->unique(); // Nro. De documento
            $table->string('email')->unique(); // Correo
            $table->string('phone'); // Teléfono
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
