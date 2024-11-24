<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedores extends Model
{
    use HasFactory;

    protected $table = 'fornecedores';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cnpj',
    ];
}
