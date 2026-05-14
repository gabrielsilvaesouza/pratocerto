<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'preco_venda',
    ];

    public function fichaTecnicas()
    {
        return $this->hasMany(FichaTecnica::class);
    }
}