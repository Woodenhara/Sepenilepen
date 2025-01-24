<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Produk;

class ProdukPolicy
{
    public function viewAny(User $user)
    {
        return in_array($user->role, ['admin', 'petugas']);
    }

    public function view(User $user, Produk $produk)
    {
        return in_array($user->role, ['admin', 'petugas']);
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'petugas']);
    }

    public function update(User $user, Produk $produk)
    {
        return in_array($user->role, ['admin', 'petugas']);
    }

    public function delete(User $user, Produk $produk)
    {
        return in_array($user->role, ['admin', 'petugas']);
    }
}
