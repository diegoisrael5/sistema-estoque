<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    // Definindo a tabela associada ao modelo (opcional, caso o nome da tabela seja pluralizada automaticamente)
    protected $table = 'funcionarios';

    // Definindo os campos que são permitidos para inserção em massa
    protected $fillable = [
        'nome',
        'cargo',
        'email',
        'telefone',
        'cpf',
    ];

    // Caso você precise de timestamps personalizados, pode configurá-los
    public $timestamps = true;
}
