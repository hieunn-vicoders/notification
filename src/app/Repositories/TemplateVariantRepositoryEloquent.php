<?php

namespace VCComponent\Laravel\Notification\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use VCComponent\Laravel\Notification\Entities\TemplateVariant;
use VCComponent\Laravel\Vicoders\Core\Exceptions\NotFoundException;
/**
 * Class AccountantRepositoryEloquent.
 */
class TemplateVariantRepositoryEloquent extends BaseRepository implements TemplateVariantRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        if (config('webpress-notification.models.template-variant')) {
            return config('webpress-notification.models.template-variant');
        }
        return TemplateVariant::class;
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
        $template_variant = $this->model->find($id);
        if (!$template_variant) {
            throw new NotFoundException('Template variant');
        }
        return $template_variant;
    }
}
