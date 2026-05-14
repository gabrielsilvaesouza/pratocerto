<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    protected $fillable = [
        'nome',
        'unidade_medida',
        'quantidade_estoque',
        'custo_unitario',
        'estoque_minimo',
    ];

    public function fichaTecnicas()
    {
        return $this->hasMany(FichaTecnica::class);
    }
}