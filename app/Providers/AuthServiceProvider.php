<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model'            => 'App\Policies\ModelPolicy',
        'App\Models\Category'  => 'App\Policies\CategoryPolicy',
        'App\Models\Ad'        => 'App\Policies\AdPolicy',
        'App\Models\Role'      => 'App\Policies\RolePolicy',
        'App\User'             => 'App\Policies\UserPolicy',
        'App\Models\City'      => 'App\Policies\CityPolicy',
        'App\Models\Field'     => 'App\Policies\FieldPolicy',
        'App\Models\Translate' => 'App\Policies\TranslatePolicy',
        'App\Models\Config'    => 'App\Policies\ConfigPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
