<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Penjualan;

class PenjualanPolicy
{
    public function viewAny(User $user)
    {
        return in_array($user->role, ['admin', 'petugas']);
    }

    public function view(User $user, Penjualan $penjualan)
    {
        return in_array($user->role, ['admin', 'petugas']);
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'petugas']);
    }

    public function update(User $user, Penjualan $penjualan)
    {
        return in_array($user->role, ['admin', 'petugas']);
    }

    public function delete(User $user, Penjualan $penjualan)
    {
        return in_array($user->role, ['admin', 'petugas']);
    }
}
