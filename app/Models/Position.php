<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use SoftDeletes, HasRoles;

    protected $fillable = [
        'name',
        'description',
    ];

    public function employes()
    {
        return $this->belongsToMany(Employe::class);
    }
}
