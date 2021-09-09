<?php

namespace VCComponent\Laravel\Notification\Listeners;

use VCComponent\Laravel\Notification\Notifications\MailVerify;

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

    public function handle($event)
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
            $user->username,
            $user->email,
            route('login')
        ));
    }
}