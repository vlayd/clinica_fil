<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Agreement extends Model
{
    use SoftDeletes, HasRoles;

    protected $fillable = [
        'name',
        'description',
    ];

    public function responsible()
    {
        return $this->belongsToMany(Responsible::class);
    }
}
