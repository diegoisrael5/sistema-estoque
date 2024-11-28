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
     
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int|null $equipamentoId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByEquipamento($query, $equipamentoId = null)
    {
        
        if ($equipamentoId) {
            return $query->where('equipamento_id', $equipamentoId);
        }

       
        return $query;
    }
}
