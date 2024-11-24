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
    ];

    public function saidas()
    {
        return $this->hasMany(SaidaEstoque::class, 'cliente_id');
    }

    protected $hidden = [

    ];
    protected static function booted()
    {
        static::saving(function ($cliente) {

            $cliente->nome = ucfirst(strtolower($cliente->nome));
        });
    }
}
