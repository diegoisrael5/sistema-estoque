<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipamento;

class SaidaEstoque extends Model
{
    use HasFactory;

    
    protected $table = 'saidas_estoque';

    
    protected $fillable = [
        'equipamento_id',
        'cliente_id',
        'funcionario_id',
        'quantidade',
        'motivo',
        'data_saida',
    ];

    public function equipamento()
    {
        return $this->belongsTo(Equipamento::class, 'equipamento_id');
    }

    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class); 
    }

    
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class); 
    }

   
    protected $dates = [
        'data_saida',
    ];
}
