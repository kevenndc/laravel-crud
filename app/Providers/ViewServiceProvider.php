<?php

namespace App\Providers;

use App\View\Composers\{PostCountComposer, SelectRoleComposer, UserCountComposer};
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('components.post-counts', PostCountComposer::class);
        View::composer('components.user-counts', UserCountComposer::class);
        View::composer('components.select-role', SelectRoleComposer::class);
    }
}
