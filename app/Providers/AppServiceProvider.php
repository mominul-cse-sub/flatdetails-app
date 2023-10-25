<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Gate::define('flat_owner', function(User $user) {
            return $user->role == 1;
        });
        Gate::define('tenant', function(User $user) {
            return $user->role == 2;
        });
        Gate::define('admin', function(User $user) {
            return $user->role == 3;
        });
    }
}
