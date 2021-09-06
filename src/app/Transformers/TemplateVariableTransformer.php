<?php

namespace VCComponent\Laravel\Notification\Transformers;

use League\Fractal\TransformerAbstract;
use VCComponent\Laravel\Notification\Entities\TemplateVariable;

class TemplateVariableTransformer extends TransformerAbstract
{

    public function transform(TemplateVariable $model)
    {
        return [
            'id'         => (int) $model->id,
            'variable'    => $model->variable,
            'notification_id' => (int) $model->notification_id,
            'timestamps' => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ],
        ];
    }
}
