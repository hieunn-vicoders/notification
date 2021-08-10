<?php

namespace VCComponent\Laravel\Notification\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use VCComponent\Laravel\Notification\Notifications\Channels\WebpressChannel;
use VCComponent\Laravel\Notification\Notifications\Messages\WebpressMessage;

class MailBlankTemplate extends Notification {
    use Queueable;

    protected $subject;

    protected $html_content;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject ,$html_content)
    {
        $this->subject = $subject;
        $this->html_content = $html_content;
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
            ->subject($this->subject)
            ->template('[vi] WEBPRESS 06 - blank template')
            ->mergeFields([
                [
                    'name'    => 'HTML_CONTENT',
                    'content' => $this->html_content,
                ],
            ]);
    }
}