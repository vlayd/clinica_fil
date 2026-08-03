<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class EmployeInfo extends Model
{
    use SoftDeletes, HasRoles;

    protected $fillable = [
        'user_id',
        'position_id',
        'documents'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'documents' => 'array',
        ];
    }
}
