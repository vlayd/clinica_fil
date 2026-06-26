<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{

    protected $fillable = ['cep', 'logradouro', 'bairro', 'localidade', 'uf', 'estado'];

    public function employees(): HasMany
    {
        return $this->hasMany(Employe::class);
    }
}
