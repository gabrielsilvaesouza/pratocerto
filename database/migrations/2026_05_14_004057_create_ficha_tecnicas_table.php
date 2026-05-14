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
        Schema::create('ficha_tecnicas', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('prato_id')
                ->constrained('pratos')
                ->onDelete('cascade');

            $table->foreignId('ingrediente_id')
                ->constrained('ingredientes')
                ->onDelete('cascade');

            $table->decimal('quantidade_utilizada', 10, 3);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_tecnicas');
    }
};
