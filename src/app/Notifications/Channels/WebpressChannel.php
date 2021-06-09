<?php

namespace VCComponent\Laravel\Notification\Notifications\Channels;

use Illuminate\Notifications\Notification;
use VCComponent\Laravel\Notification\Services\Api\WebpressNotificationApi;

class WebpressChannel
{
    private $api;

    public function __construct(WebpressNotificationApi $api)
    {
        $this->api = $api;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWebpress($notifiable);
        $this->api->send($message->buildParams());
    }
}
