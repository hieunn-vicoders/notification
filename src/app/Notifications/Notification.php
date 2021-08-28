<?php

namespace VCComponent\Laravel\Notification\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification as BaseNotification;
use VCComponent\Laravel\Notification\Notifications\Channels\WebpressChannel;
use VCComponent\Laravel\Notification\Notifications\Messages\WebpressMessage;

class Notification extends BaseNotification
{
    use Queueable;

    protected $notification;
    protected $template_variants;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notification, array $template_variants)
    {
        $this->notification = $notification;
        $this->template_variants = $template_variants;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $channels = [];
        if ($this->notification->canSentEmailNotificatonToUser($notifiable->id)) array_push($channels, WebpressChannel::class);
        if ($this->notification->canSendMobileNotificationToUser($notifiable->id)) array_push($channels, 'mobile_channel');
        if ($this->notification->candSendWebNotificationToUser($notifiable->id)) array_push($channels, 'web_channel');
        return $channels;
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
            ->subject($this->notification->name)
            ->template('[vi] WEBPRESS 06 - blank template')
            ->mergeFields([
                [
                    'name'    => 'CONTENT',
                    'content' => $this->mergeContentVariants($this->notification->email_template),
                ],
            ]);
    }

    /**
     * 
     */
    protected function mergeContentVariants($notification_content)
    {
        $search = [];
        $replace = [];

        foreach ($this->template_variants as $key => $value) {
            $key = '*|' . $key . '|*';
            $search = array_merge($search, $key);
            $replace = array_merge($replace, [$key => $value]);
        }

        return str_replace($search, $replace, $notification_content);
    }
}
