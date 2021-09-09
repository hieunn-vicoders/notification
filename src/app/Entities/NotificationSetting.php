<?php

namespace VCComponent\Laravel\Notification\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class NotificationSetting extends Model implements Transformable
{
    use TransformableTrait;

    public $timestamps = false;

    public const ENABLE = 1;
    public const DISABLE = 0;

    public const TYPE_ROLE = 'roles';
    public const TYPE_USER = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'notification_id',
        'notificationable_id',
        'email_enable',
        'mobile_enable',
        'web_enable',
        'notificationable_type'
    ];

    public function notification() {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }

    /**
     * Lấy setting nottification của user
     * 
     * @param integer $user_id
     * 
     * @return \Illuminate\Support\Collection
     */
    public function getUserSetting($user_id) {
        return $this->where('notificationable_id', $user_id)->where('notificationable_type', static::TYPE_USER)->with('notification')->get();
    }
}
