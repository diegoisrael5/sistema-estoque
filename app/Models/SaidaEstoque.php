<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipamento;

class SaidaEstoque extends Model
{
    use HasFactory;

    // Define a tabela associada ao modelo
    protected $table = 'saidas_estoque';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'equipamento_id',
        'cliente_id',
        'funcionario_id',
        'quantidade',
        'motivo',
        'data_saida',
    ];

    // Relacionamento com Equipamento
    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, 'equipamento_id');
    }

    // Relacionamento com Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class); // Relação de muitos para um com Cliente
    }

    // Relacionamento com Funcionario
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class); // Relação de muitos para um com Funcionario
    }

    // Definindo a data como tipo Carbon (caso necessário)
    protected $dates = [
        'data_saida',
    ];
}
