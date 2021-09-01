<?php

return [
    'namespace' => '',

    'models' => [
        'notifcation' => \VCComponent\Laravel\Notification\Entities\Notification::class,
        'notifcation-setting' => \VCComponent\Laravel\Notification\Entities\NotificationSetting::class,
        'template-variable' => \VCComponent\Laravel\Notification\Entities\TemplateVariable::class,
    ],

    'base_url' => env('WEBPRESS_NOTIFICATION_BASE_URL', 'https://api.dev.webpress.vn/communication'),

    'version'  => env('WEBPRESS_NOTIFICATION_VERSION', 'v1.0'),

    'auth_middleware' => [
        'admin'    => [
            [
                'middleware' => '',
                'except'     => [],
            ],
        ],
        'frontend'    => [
            [
                'middleware' => '',
                'except'     => [],
            ],
        ],
    ],

    'transformers' => [
        'template-variable' => \VCComponent\Laravel\Notification\Transformers\TemplateVariableTransformer::class,
        'notification' => \VCComponent\Laravel\Notification\Transformers\NotificationTransformer::class,
        'notification-setting' => \VCComponent\Laravel\Notification\Transformers\NotificationSettingTransformer::class
    ]
];
