<?php

namespace VCComponent\Laravel\Notification\Transformers;

use League\Fractal\TransformerAbstract;
use VCComponent\Laravel\Notification\Entities\Notification;
use VCComponent\Laravel\Notification\Entities\NotificationSetting;

class NotificationSettingTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'notification'
    ];

    public function __construct($includes = [])
    {
        $this->setDefaultIncludes($includes);
    }

    public function transform(NotificationSetting $model)
    {
        return [
            'id'                    => (int) $model->id,
            'notification_id'       => (int) $model->notification_id,
            'notificationable_id'   => (int) $model->notificationable_id,
            'email_enable'          => $model->email_enable,
            'mobile_enable'         => $model->mobile_enable,
            'web_enable'            => $model->web_enable,
            'notificationable_type' => $model->notificationable_type
        ];
    }

    
    public function includeTemplateVariable(Notification $model) {
        return $this->collection($model->notification, new TemplateVariableTransformer);
    }
}
