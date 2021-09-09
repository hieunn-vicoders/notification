<?php

namespace VCComponent\Laravel\Notification\Listeners;

use VCComponent\Laravel\Notification\Entities\Notification as EntitiesNotification;
use VCComponent\Laravel\Notification\Notifications\Channels\MobileChannel;
use VCComponent\Laravel\Notification\Notifications\Channels\WebpressChannel;
use VCComponent\Laravel\Notification\Notifications\Notification;
use VCComponent\Laravel\Notification\Repositories\NotificationSettingRepository;
use VCComponent\Laravel\User\Entities\User;

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

    public function handle($event)
    {
        $notification = $event->notification;

        if ($notification instanceof Notification) {
            $model = $notification->notification;
            if (!$model instanceof EntitiesNotification) {
                return false;
            }
            $users = $notification->to_users;
    
            $user_ids = $users->pluck('id')->toArray();
            array_push($user_ids, $event->notifiable->id);
            $query = $this->notificatoin_setting_entity
                    ->whereIn('notificationable_id', $user_ids)
                    ->where('notification_id', $model->id)
                    ->where('notificationable_type', $this->notificatoin_setting_entity::TYPE_USER);
            if ($event->channel == WebpressChannel::class) {
                $query = $query->where('email_enable', 1);
            }
            if ($event->channel == MobileChannel::class) {
                $query = $query->where('mobile_enable', 1);
            }
            $notificationable_ids = $query->get()->pluck('notificationable_id')->toArray();
            
            $to_users = $users->filter(function ($user) use ($notificationable_ids) {
                return in_array($user->id, $notificationable_ids);
            })->pluck('email')->toArray();
    
            if (!count($to_users)) {
                return false;
            }

            $notification->to_users = $to_users;
        }
        return true;
    }
}
