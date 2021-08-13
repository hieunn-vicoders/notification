<?php

namespace VCComponent\Laravel\Notification\Listeners;

use VCComponent\Laravel\Notification\Notifications\MailRegister;
use VCComponent\Laravel\Notification\Notifications\MailResendVerify;
use VCComponent\Laravel\User\Events\ResendVerifyEmailEvent;

class ResendVerifyEmailListener
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
     * @param  ResendVerifyEmailEvent  $event
     * @return void
     */
    public function handle(ResendVerifyEmailEvent $event)
    {
        $user = $event->user;
        $user->notify(new MailResendVerify(
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
            asset("verify/{$user->id}?token={$user->verify_token}")
        ));
    }
}