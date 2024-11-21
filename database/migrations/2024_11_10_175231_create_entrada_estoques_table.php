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
        Schema::create('entrada_estoques', function (Blueprint $table) {
            $table->id();
            // Relacionamento com equipamentos
            $table->foreignId('equipamento_id')->constrained('equipamentos')->onDelete('cascade');
            // Relacionamento com fornecedores
            $table->foreignId('fornecedor_id')->constrained('fornecedores')->onDelete('cascade');
            $table->integer('quantidade');
            $table->decimal('valor', 8, 2); // Coluna para o valor, ajustável conforme necessário
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_estoques');
    }
};
