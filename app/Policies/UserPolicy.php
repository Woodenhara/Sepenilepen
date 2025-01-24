<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return $user->role === 'admin';
    }

    public function view(User $user, User $model)
    {
        return $user->role === 'admin';
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, User $model)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, User $model)
    {
        return $user->role === 'admin';
    }
}
