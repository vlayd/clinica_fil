<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Patient');
    }

    public function view(AuthUser $authUser): bool
    {
        return $authUser->can('View:Patient');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Patient');
    }

    public function update(AuthUser $authUser): bool
    {
        return $authUser->can('Update:Patient');
    }

    public function delete(AuthUser $authUser): bool
    {
        return $authUser->can('Delete:Patient');
    }

    public function isUser(AuthUser $authUser): bool
    {
        return $authUser->can('IsUser:Patient');
    }

}