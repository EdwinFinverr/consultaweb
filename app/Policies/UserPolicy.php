<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function createInversion(User $authUser, User $user)
    {
        return $authUser->id === $user->id;
    }
    public function createBeneficiario(User $authUser, User $user)
    {
        return $authUser->id === $user->id;
    }
    public function patchInversion(User $authUser, User $user)
    {
        return $authUser->id === $user->id;
    }
}