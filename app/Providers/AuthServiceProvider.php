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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
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
            if($user->email === 'admin@gmail.com'){
                return true;
            }else{
                return false;
            }

        });


        Gate::define('isManger',function($user){
            if($user->email === 'manager@gmail.com'){
                return true;
            }else{
                return false;
            }

        });

        Gate::define('isEditor',function($user){
            if($user->email === 'editor@gmail.com'){
                return true;
            }else{
                return false;
            }

        });
    }
}
