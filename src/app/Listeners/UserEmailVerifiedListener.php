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
            'https://vmms.vn/assets/images/img/logo-nen.png',
            'https://www.facebook.com/VMMS-326462230790779',
            null,
            null,
            '(+84-4) 3562.6296',
            'info@vmms.vn',
            null,
            null,
            null,
            $user->name,
            $user->email,
            route('login')
        ));
    }
}