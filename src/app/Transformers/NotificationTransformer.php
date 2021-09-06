<?php

namespace VCComponent\Laravel\Notification\Transformers;

use League\Fractal\TransformerAbstract;
use VCComponent\Laravel\Notification\Entities\Notification;

class NotificationTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'templateVariable'
    ];

    public function __construct($includes = [])
    {
        $this->setDefaultIncludes($includes);
    }

    public function transform(Notification $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'    => $model->name,
            'slug' => $model->slug,
            'email_template'   => $model->email_template,
            'mobile_template'      => $model->mobile_template,
            'web_template' => $model->web_template,
            'timestamps' => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ],
        ];
    }

    public function includeTemplateVariable(Notification $model) {
        return $this->collection($model->templateVariables, new TemplateVariableTransformer);
    }
}
