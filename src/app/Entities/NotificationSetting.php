<?php

namespace VCComponent\Laravel\Notification\Entities;

use Illuminate\Database\Eloquent\Model;
use NF\Roles\Models\Role;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use VCComponent\Laravel\User\Entities\UserHasRole;

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
        'type'
    ];

    public function notification() {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }

    public function role() {
        return $this->morphTo(Role::class, 'roles');
    }

    /**
     * Lấy danh sách thông báo user có thể setting
     * 
     * @param integer $user_id
     * 
     * @return \Illuminate\Support\Collection
     */
    public function getUserConfigableNotifications($user_id) {
        $role_ids = UserHasRole::where('user_id', $user_id)->get()->pluck('role_id')->toArray();

        return $this->selectRaw("
                id, 
                notification_id, 
                notificationable_id,
                sum(email_enable) as email_enable,
                sum(mobile_enable) as mobile_enable,
                sum(web_enable) as web_enable,
                type
            ")->whereIn('notificationable_id', $role_ids)->where('type', static::TYPE_ROLE)->groupBy('notification_id')->with('notification')->orderBy('id', 'DESC')->get();
    }

    /**
     * Lấy setting nottification của user
     * 
     * @param integer $user_id
     * 
     * @return \Illuminate\Support\Collection
     */
    public function getUserSetting($user_id) {
        return $this->where('notificationable_id', $user_id)->where('type', static::TYPE_USER)->with('notification')->get();
    }
}
