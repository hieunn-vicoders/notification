<?php

namespace VCComponent\Laravel\Notification\Listeners;

use VCComponent\Laravel\Notification\Notifications\MailRegister;
use VCComponent\Laravel\Notification\Notifications\MailVerify;
use VCComponent\Laravel\User\Events\UserEmailVerifiedEvent;

class UserEmailVerifiedListener
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
     * @param  UserEmailVerifiedEvent  $event
     * @return void
     */
    public function handle(UserEmailVerifiedEvent $event)
    {
        $user = $event->user;
        $user->notify(new MailVerify(
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
            route('login')
        ));
    }
}