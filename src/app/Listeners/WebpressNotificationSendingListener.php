<?php

namespace VCComponent\Laravel\Notification\Listeners;

use Illuminate\Notifications\Events\NotificationSending;
use VCComponent\Laravel\Notification\Entities\Notification;
use VCComponent\Laravel\Notification\Notifications\Channels\WebpressChannel;
use VCComponent\Laravel\Notification\Notifications\Notification as NotificationsNotification;
use VCComponent\Laravel\Notification\Repositories\NotificationSettingRepository;
use VCComponent\Laravel\User\Entities\User;
use VCComponent\Laravel\User\Events\UserRegisteredEvent;

class WebpressNotificationSendingListener
{
    protected $notification_setting;
    protected $notification_setting_entity;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(NotificationSettingRepository $notification_setting)
    {
        $this->notificatoin_setting = $notification_setting;
        $this->notificatoin_setting_entity = $notification_setting->getEntity();
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegisteredEvent  $event
     * @return void
     */
    public function handle(NotificationSending $event)
    {
        $class_notification = $event->notification;

        if ($class_notification instanceof NotificationsNotification) {
            $notification = $class_notification->notification;
            if (!$notification instanceof Notification) {
                return false;
            }
            array_push($class_notification->to_addresses, $event->notifiable->email);
            $users = User::whereIn('email', $class_notification->to_addresses)->get();
    
            $user_ids = $users->pluck('id')->toArray();
    
            $query = $this->notificatoin_setting_entity
                    ->whereIn('notificationable_id', $user_ids)
                    ->where('notification_id', $notification->id)
                    ->where('notificationable_type', $this->notificatoin_setting_entity::TYPE_USER);
            if ($event->channel == WebpressChannel::class) {
                $query = $query->where('email_enable', 1);
            }
            $notificationable_ids = $query->get()->pluck('id')->toArray();
            
            $to_addresses = $users->filter(function ($user) use ($notificationable_ids) {
                return in_array($user->id, $notificationable_ids);
            })->pluck('email')->toArray();
    
            if (!count($to_addresses)) {
                return false;
            }
    
            $class_notification->to_addresses = $to_addresses;
        }
        return true;
    }
}
