<?php

namespace Quyenvkbn\System;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Spatie\Permission\Models\Role' => 'Quyenvkbn\System\Policies\RolePolicy',
        'Quyenvkbn\System\Models\User' => 'Quyenvkbn\System\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->policies[config("auth.providers.users.model")] = 'Quyenvkbn\System\Policies\UserPolicy';

        $this->registerPolicies();

        //
    }
}
