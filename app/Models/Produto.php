<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'quantidade',
    ];

    protected $casts = [
        'nome' => 'string',
        'descricao' => 'string',
        'preco' => 'decimal:2',
        'quantidade' => 'integer',
    ];
}
