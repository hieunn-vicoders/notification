<?php

namespace VCComponent\Laravel\Notification\Listeners;

use VCComponent\Laravel\Notification\Notifications\MailResetPasswordToken;

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

    public function handle($event)
    {
        $reset_password_url = request()->get('reset_password_url');
        $user = $event->user;
        $token = $event->token;
        $user->notify(new MailResetPasswordToken(
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
            "{$reset_password_url}?token={$token}"
        ));
    }
}