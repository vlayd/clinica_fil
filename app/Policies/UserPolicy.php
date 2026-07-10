<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    
    public function resetPassword(AuthUser $authUser): bool
    {
        return $authUser->can('ResetPassword:User');
    }

}