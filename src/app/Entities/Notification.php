<?php

namespace VCComponent\Laravel\Notification\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use VCComponent\Laravel\User\Entities\UserHasRole;

class Notification extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'slug',
        'email_template',
        'mobile_template',
        'web_template',
    ];

    public function templateVariants() {
        return $this->hasMany(TemplateVariant::class);
    }

    public function canSentEmailNotificatonToUser($user_id) {
        $notification_setting = NotificationSetting::where('notification_id', $this->id)->where('notificationable_id', $user_id)->where('type', NotificationSetting::TYPE_USER)->first();

        if ($notification_setting->email_enable) {
            return true;
        }
        return false;
    }

    public function canSendMobileNotificationToUser($user_id) {
        $notification_setting = NotificationSetting::where('notification_id', $this->id)->where('notificationable_id', $user_id)->where('type', NotificationSetting::TYPE_USER)->first();

        if ($notification_setting->mobile_enable) {
            return true;
        }
        return false;
    }
    public function candSendWebNotificationToUser($user_id) {
        $notification_setting = NotificationSetting::where('notification_id', $this->id)->where('notificationable_id', $user_id)->where('type', NotificationSetting::TYPE_USER)->first();

        if ($notification_setting->web_enable) {
            return true;
        }
        return false;
    }
}
