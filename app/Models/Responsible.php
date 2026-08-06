<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Responsible extends Model
{
    use SoftDeletes, HasRoles;

    protected $fillable = [
        'name',
        'agreements',
        'patient_id',
        'cpf',
        'documents',
        'description',
    ];

    protected $casts = [
        'agreements' => 'array',
    ];

    public function patient()
    {
        return $this->belongsToMany(Patient::class);
    }

    public function agreement()
    {
        return $this->belongsToMany(Agreement::class);
    }
}
