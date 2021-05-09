<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
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
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // get all cached permissions.
        // if there are no permissions cached yet, then cache all permissions.
        $permissions = Cache::rememberForever('user-permissions', function () {
            return Permission::all();
        });

        $permissions->map(function ($permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                return $user->role->hasPermissionTo($permission->name);
            });
        });
    }
}
