<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    
        Gate::define('isAdmin',function($user){
            $roles=$user->roles()->get();
            foreach($roles as $role){
                if('Administrator'==$role->name)
                    return true;
            }
            return false;
        });
        Gate::define('isModerator',function($user){
            $roles=$user->roles()->get();
            foreach($roles as $role){
                if('Moderator'==$role->name)
                    return true;
            }
            return false;
        });
        Gate::define('isAuthorized',function($user){
            $roles=$user->roles()->get();
            foreach($roles as $role){
                if('Administrator'==$role->name||'Moderator'==$role->name)
                    return true;
            }
            return false;
        });
        //
    }
}
