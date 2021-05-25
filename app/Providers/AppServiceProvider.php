<?php

namespace App\Providers;

use App\Services\FlashMessagesService;
use App\Services\LocalUploadStorageService;
use App\Services\MessageNotificationService;
use App\Services\UploadStorageService;
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
        $this->app->bind(UploadStorageService::class, LocalUploadStorageService::class);
        $this->app->bind(MessageNotificationService::class, FlashMessagesService::class);
    }
}
