<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaTecnica extends Model
{
    protected $fillable = [
        'prato_id',
        'ingrediente_id',
        'quantidade_utilizada',
    ];

    public function prato()
    {
        return $this->belongsTo(Prato::class);
    }

    public function ingrediente()
    {
        return $this->belongsTo(Ingrediente::class);
    }
}