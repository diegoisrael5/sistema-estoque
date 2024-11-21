<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedores extends Model
{
    use HasFactory;

    // Adicione os campos permitidos para atribuição em massa
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'endereco',
        'cnpj',
    ];
}
