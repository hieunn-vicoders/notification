<?php

namespace VCComponent\Laravel\Notification\Notifications\Channels;

use Illuminate\Notifications\Notification;
use VCComponent\Laravel\Notification\Services\Api\MobileNotificationApi;

class MobileChannel
{
    private $api;

    public function __construct(MobileNotificationApi $api)
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
        $message = $notification->toMobile($notifiable);
        $this->api->send($message->buildParams());
    }
}