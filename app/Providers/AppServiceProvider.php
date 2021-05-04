<?php

namespace App\Providers;

use App\Models\Post;
use App\Observers\PostObserver;
use App\Services\LocalUploadStorageService;
use App\Services\UploadStorageService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        app()->bind(UploadStorageService::class, LocalUploadStorageService::class);
    }
}
