<?php

namespace VCComponent\Laravel\Notification\Providers;

use Illuminate\Notifications\Events\NotificationSending;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use VCComponent\Laravel\Notification\Listeners\WebpressNotificationSendingListener;

class NotificationEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        NotificationSending::class => [
            WebpressNotificationSendingListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
