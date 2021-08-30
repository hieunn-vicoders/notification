<?php

namespace VCComponent\Laravel\Notification\Providers;

use Illuminate\Support\ServiceProvider;
use VCComponent\Laravel\Notification\Repositories\NotificationRepository;
use VCComponent\Laravel\Notification\Repositories\NotificationRepositoryEloquent;
use VCComponent\Laravel\Notification\Repositories\NotificationSettingRepository;
use VCComponent\Laravel\Notification\Repositories\NotificationSettingRepositoryEloquent;
use VCComponent\Laravel\Notification\Repositories\TemplateVariantRepository;
use VCComponent\Laravel\Notification\Repositories\TemplateVariantRepositoryEloquent;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services
     *
     * @return void
     */
    public function boot()
    {
        
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        $this->publishes([
            __DIR__ . '/../../config/webpress-notification.php' => config_path('webpress-notification.php'),
        ], 'config');
    }

    /**
     * Register any package services
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(NotificationRepository::class, NotificationRepositoryEloquent::class);
        $this->app->bind(NotificationSettingRepository::class, NotificationSettingRepositoryEloquent::class);
        $this->app->bind(TemplateVariantRepository::class, TemplateVariantRepositoryEloquent::class);
        $this->app->register(NotificationEventServiceProvider::class);
    }
}
