<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Agreement;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgreementPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Agreement');
    }

    public function view(AuthUser $authUser, Agreement $agreement): bool
    {
        return $authUser->can('View:Agreement');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Agreement');
    }

    public function update(AuthUser $authUser, Agreement $agreement): bool
    {
        return $authUser->can('Update:Agreement');
    }

    public function delete(AuthUser $authUser, Agreement $agreement): bool
    {
        return $authUser->can('Delete:Agreement');
    }

}