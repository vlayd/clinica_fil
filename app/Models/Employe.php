<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employe extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'image', 'birth', 'email', 'password', 'active'];

    public function address():BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
