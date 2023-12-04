<?php

namespace App\Providers;

use App\Models\Cliente; 
use App\Policies\ClientePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Cliente::class => ClientePolicy::class,
    ];
    
    public function boot()
    {
        $this->registerPolicies();
    
        Gate::define('create-cliente', 'App\Policies\ClientePolicy@create');
    }
}
