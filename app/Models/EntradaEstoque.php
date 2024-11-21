<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaEstoque extends Model
{
    use HasFactory;

    protected $fillable = ['equipamento_id', 'fornecedor_id', 'quantidade', 'valor'];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedores::class, 'fornecedor_id');  // Ajuste o nome da model
    }

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class);
    }



    /**
     * Escopo para filtrar entradas de estoque por equipamento.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int|null $equipamentoId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByEquipamento($query, $equipamentoId = null)
    {
        // Se o ID do equipamento for fornecido, aplica o filtro
        if ($equipamentoId) {
            return $query->where('equipamento_id', $equipamentoId);
        }

        // Retorna o query sem filtro, caso o ID não seja fornecido
        return $query;
    }
}
