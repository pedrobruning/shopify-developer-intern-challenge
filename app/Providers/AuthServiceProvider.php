<?php

namespace App\Providers;

use App\Models\Photo;
use App\Models\User;
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

        Gate::define('manage-photo', function(User $user, Photo $photo) {
            return $user->id === $photo->user_id && $photo->bought === 0;
        });
        Gate::define('delete-photo', function(User $user, Photo $photo) {
            return $photo->sales()->count() <= 0;
        });
        //
    }
}
