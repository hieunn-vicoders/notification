<?php

namespace VCComponent\Laravel\Notification\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use VCComponent\Laravel\Notification\Entities\TemplateVariable;
use VCComponent\Laravel\Vicoders\Core\Exceptions\NotFoundException;
/**
 * Class AccountantRepositoryEloquent.
 */
class TemplateVariableRepositoryEloquent extends BaseRepository implements TemplateVariableRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        if (config('webpress-notification.models.template-variable')) {
            return config('webpress-notification.models.template-variable');
        }
        return TemplateVariable::class;
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
        $template_variable = $this->model->find($id);
        if (!$template_variable) {
            throw new NotFoundException('Template variable');
        }
        return $template_variable;
    }
}
