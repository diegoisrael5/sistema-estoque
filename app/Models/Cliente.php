<?php

// app/Models/Cliente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'endereco',
        'cpf',
        'data_nascimento',
    ];

    // Definir os atributos que devem ser convertidos para um tipo específico
    protected $casts = [
        'data_nascimento' => 'date', // Garantir que a data de nascimento seja tratada como uma data
    ];

    // Relacionamento: Um cliente pode ter várias saídas de estoque (se aplicável)
    public function saidas()
    {
        return $this->hasMany(SaidaEstoque::class, 'cliente_id');
    }

    // Definir os atributos que devem ser ocultados ao retornar o modelo para a interface (API, por exemplo)
    protected $hidden = [
        // 'cpf', (caso não queira exibir o CPF, por exemplo, nas respostas JSON)
    ];

    // Caso você queira adicionar lógica antes de salvar, atualizar ou excluir um cliente
    protected static function booted()
    {
        static::saving(function ($cliente) {
            // Lógica antes de salvar o cliente (exemplo: formatação do nome)
            $cliente->nome = ucfirst(strtolower($cliente->nome)); // Capitaliza o nome
        });
    }
}
