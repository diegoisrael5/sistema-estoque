<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaidasEstoqueTable extends Migration
{
    public function up()
    {
        Schema::create('saidas_estoque', function (Blueprint $table) {
            $table->id(); // ID único da tabela

            // Relacionamento com a tabela 'equipamentos'
            $table->foreignId('equipamento_id')
                ->constrained()
                ->onUpdate('cascade') // Atualiza se o ID for alterado
                ->onDelete('restrict'); // Restringe a exclusão se houver dependência

            // Relacionamento com a tabela 'clientes'
            $table->foreignId('cliente_id')
                ->nullable() // Permitir valores nulos, caso o cliente seja opcional
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('set null'); // Define como nulo se o cliente for excluído

            // Relacionamento com a tabela 'funcionarios'
            $table->foreignId('funcionario_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->integer('quantidade')->unsigned(); // Garantir quantidade positiva
            $table->string('motivo', 255); // Motivo da saída (tamanho limitado para performance)
            $table->date('data_saida'); // Data de saída do equipamento

            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('saidas_estoque'); // Remove a tabela caso necessário
    }
}
