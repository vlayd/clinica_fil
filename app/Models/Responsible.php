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
        'patient_id ',
        'name',
        'cpf',
        'documents',
        'description',
    ];

    public function patient()
    {
        return $this->belongsToMany(Patient::class);
    }

    public function agreements()
    {
        return $this->belongsToMany(Agreement::class);
    }
}
