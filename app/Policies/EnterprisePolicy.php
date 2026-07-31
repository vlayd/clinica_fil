<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Enterprise;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnterprisePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Enterprise');
    }

    public function view(AuthUser $authUser, Enterprise $enterprise): bool
    {
        return $authUser->can('View:Enterprise');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Enterprise');
    }

    public function update(AuthUser $authUser, Enterprise $enterprise): bool
    {
        return $authUser->can('Update:Enterprise');
    }

}