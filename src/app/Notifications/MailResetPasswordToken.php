<?php

namespace VCComponent\Laravel\Notification\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use VCComponent\Laravel\Notification\Notifications\Channels\WebpressChannel;
use VCComponent\Laravel\Notification\Notifications\Messages\WebpressMessage;

class MailResetPasswordToken extends Notification {
    use Queueable;

    protected $logo_url;

    protected $facebook_url;

    protected $google_url;

    protected $twitter_url;
    
    protected $phone_number;

    protected $service_email;

    protected $main_color;

    protected $secondary_color;

    protected $background_color;

    protected $username;
    
    protected $user_email;

    protected $reset_password_url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        $logo_url,
        $facebook_url,
        $google_url,
        $twitter_url,
        $phone_number,
        $service_email,
        $main_color,
        $secondary_color,
        $background_color,
        $username,
        $user_email,
        $reset_password_url
    )
    {
        $this->logo_url = $logo_url;
        $this->facebook_url = $facebook_url;
        $this->google_url = $google_url;
        $this->twitter_url = $twitter_url;
        $this->phone_number = $phone_number;
        $this->service_email = $service_email;
        $this->main_color = $main_color;
        $this->secondary_color = $secondary_color;
        $this->background_color = $background_color;
        $this->username = $username;
        $this->user_email = $user_email;
        $this->reset_password_url = $reset_password_url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebpressChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toWebpress($notifiable)
    {
        return (new WebpressMessage())
            ->to($notifiable->email)
            ->subject('Reset Password')
            ->template('[vi] WEBPRESS 01 - reset your password')
            ->mergeFields([
                [
                    'name'    => 'LOGO_URL',
                    'content' => $this->logo_url,
                ],
                [
                    'name'    => 'FACEBOOK_URL',
                    'content' => $this->facebook_url,
                ],
                [
                    'name'    => 'GOOGLE_URL',
                    'content' => $this->google_url,
                ],
                [
                    'name'    => 'TWITTER_URL',
                    'content' => $this->twitter_url,
                ],
                [
                    'name'    => 'PHONE_NUMBER',
                    'content' => $this->phone_number,
                ],
                [
                    'name'    => 'SERVICE_EMAIL',
                    'content' => $this->service_email,
                ],
                [
                    'name'    => 'MAIN_COLOR',
                    'content' => $this->main_color,
                ],
                [
                    'name'    => 'SECONDARY_COLOR',
                    'content' => $this->secondary_color,
                ],
                [
                    'name'    => 'BACKGROUND_COLOR',
                    'content' => $this->background_color,
                ],
                [
                    'name'    => 'USERNAME',
                    'content' => $this->username,
                ],
                [
                    'name'    => 'USER_EMAIL',
                    'content' => $this->user_email,
                ],
                [
                    'name'    => 'RESET_PASSWORD_URL',
                    'content' => $this->reset_password_url,
                ],
            ]);
    }
}