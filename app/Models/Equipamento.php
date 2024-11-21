<?php

// app/Models/Equipamento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    use HasFactory;

    // Definir a tabela associada a este modelo
    protected $table = 'equipamentos';

    // Definir os atributos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'nome',         // Nome do equipamento
        'descricao',    // Descrição do equipamento
        'quantidade',   // Quantidade de equipamentos disponíveis
    ];

    // Definir os atributos que devem ser convertidos para um tipo específico
    protected $casts = [
        'quantidade' => 'integer',  // Garantir que 'quantidade' seja tratada como um inteiro
    ];

    // Definir os atributos que devem ser ocultados ao retornar o modelo para a interface (API, por exemplo)
    protected $hidden = [
        // 'senha', (caso exista algum campo sensível como senha ou token)
    ];

    // Caso queira criar relacionamentos com outros modelos (por exemplo, SaidaEstoque)
    public function saidas()
    {
        return $this->hasMany(SaidaEstoque::class, 'equipamento_id');
    }

    // Caso seja necessário utilizar eventos do modelo, como "saving", "saved", etc.
    protected static function booted()
    {
        static::saving(function ($equipamento) {
            // Lógica antes de salvar o equipamento
            $equipamento->nome = strtoupper($equipamento->nome);  // Exemplo: transforma o nome para maiúsculas antes de salvar
        });
    }
}
