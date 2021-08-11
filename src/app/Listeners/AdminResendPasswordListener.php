<?php

namespace VCComponent\Laravel\Notification\Listeners;

use VCComponent\Laravel\Notification\Notifications\MailResetPasswordToken;
use VCComponent\Laravel\User\Events\AdminResendPasswordEvent;

class AdminResendPasswordListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AdminResendPasswordEvent  $event
     * @return void
     */
    public function handle(AdminResendPasswordEvent $event)
    {
        $reset_password_url = request()->get('reset_password_url');
        $user = $event->user;
        $token = $event->token;
        $user->notify(new MailResetPasswordToken(
            'https://cdn.zeplin.io/5d8877494f3ff161cea03412/assets/6e98e7c5-5202-4868-9b06-528add66309e.png',
            null,
            null,
            null,
            '0987654321',
            'email_develop@vicoders.com',
            null,
            null,
            null,
            $user->name,
            $user->email,
            "{$reset_password_url}?token={$token}"
        ));
    }
}