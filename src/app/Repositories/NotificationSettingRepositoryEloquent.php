<?php

namespace VCComponent\Laravel\Notification\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use VCComponent\Laravel\Notification\Entities\NotificationSetting;
use VCComponent\Laravel\Vicoders\Core\Exceptions\NotFoundException;
/**
 * Class AccountantRepositoryEloquent.
 */
class NotificationSettingRepositoryEloquent extends BaseRepository implements NotificationSettingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        if (config('webpress-notification.models.notification-setting')) {
            return config('webpress-notification.models.notification-setting');
        }
        return NotificationSetting::class;
    }

    public function getEntity()
    {
        return $this->model;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findById($id)
    {
        $notificationSetting = $this->model->find($id);
        if (!$notificationSetting) {
            throw new NotFoundException('Notification setting');
        }
        return $notificationSetting;
    }
}
