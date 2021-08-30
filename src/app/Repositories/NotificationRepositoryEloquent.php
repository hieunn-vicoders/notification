<?php

namespace VCComponent\Laravel\Notification\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use VCComponent\Laravel\Notification\Entities\Notification;
use VCComponent\Laravel\Vicoders\Core\Exceptions\NotFoundException;
/**
 * Class AccountantRepositoryEloquent.
 */
class NotificationRepositoryEloquent extends BaseRepository implements NotificationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        if (config('webpress-notification.models.notification')) {
            return config('webpress-notification.models.notification');
        }
        return Notification::class;
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
        $notification = $this->model->find($id);
        if (!$notification) {
            throw new NotFoundException('Notification');
        }
        return $notification;
    }
}
