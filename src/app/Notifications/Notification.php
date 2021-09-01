<?php

namespace VCComponent\Laravel\Notification\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification as BaseNotification;
use VCComponent\Laravel\Notification\Notifications\Channels\WebpressChannel;
use VCComponent\Laravel\Notification\Notifications\Messages\WebpressMessage;

class Notification extends BaseNotification
{
    use Queueable;

    public $notification;
    public $template_variables;
    public $to_addresses;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notification, array $template_variables = null, array $to_addresses)
    {
        $this->notification = $notification;
        $this->template_variables = $template_variables;
        $this->to_addresses = $to_addresses;
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
            ->toMany($this->to_addresses)
            ->subject($this->notification->name)
            ->template('[vi] WEBPRESS 06 - blank template')
            ->mergeFields([
                [
                    'name'    => 'HTML_CONTENT',
                    'content' => $this->mergeContentVariables($this->notification->email_template),
                ],
            ]);
    }

    /**
     * 
     */
    protected function mergeContentVariables($notification_content)
    {
        $search = [];
        $replace = [];

        foreach ($this->template_variables as $key => $value) {
            $key = '*|' . $key . '|*';
            $search = array_merge($search, $key);
            $replace = array_merge($replace, [$key => $value]);
        }

        return str_replace($search, $replace, $notification_content);
    }
}
