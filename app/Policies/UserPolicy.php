<?php

namespace App\Policies;

use App\User;
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

    public function update($user)
    {
        return $user->id === auth()->user()->id;
    }

    public function delete($user)
    {
        return $user->id === auth()->user()->id;
    }
}
