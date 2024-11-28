<?php

// app/Models/Equipamento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    use HasFactory;

    
    protected $table = 'equipamentos';

    
    protected $fillable = [
        'nome',         
        'descricao',   
        'quantidade',  
    ];

   
    protected $casts = [
        'quantidade' => 'integer',  
    ];

   
    protected $hidden = [
       
    ];

    
    public function saidas()
    {
        return $this->hasMany(SaidaEstoque::class, 'equipamento_id');
    }


    protected static function booted()
    {
        static::saving(function ($equipamento) {
            
            $equipamento->nome = strtoupper($equipamento->nome);  
    }
}
