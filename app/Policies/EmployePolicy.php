<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Employe');
    }

    public function view(AuthUser $authUser): bool
    {
        return $authUser->can('View:Employe');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Employe');
    }

    public function update(AuthUser $authUser): bool
    {
        return $authUser->can('Update:Employe');
    }

    public function delete(AuthUser $authUser): bool
    {
        return $authUser->can('Delete:Employe');
    }

}