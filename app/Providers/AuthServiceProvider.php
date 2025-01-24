<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\{Produk, Penjualan, User};
use App\Policies\{ProdukPolicy, PenjualanPolicy, UserPolicy};

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Produk::class => ProdukPolicy::class,
        Penjualan::class => PenjualanPolicy::class,
        User::class => UserPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
