<?php

namespace VCComponent\Laravel\Notification\Validators;

use VCComponent\Laravel\Vicoders\Core\Validators\AbstractValidator;
use VCComponent\Laravel\Vicoders\Core\Validators\ValidatorInterface;

class NotificationSettingValidator extends AbstractValidator
{
    protected $rules = [
        'SYNC_WEBSITE_NOTIFICATION_SETTING' => [
            'role_id'       => ['required', 'integer'],
            'email_template_ids'      => ['array'],
            'email_template_ids.*'    => ['integer'],
            'mobile_template_ids'     => ['array'],
            'mobile_template_ids.*'   => ['integer'],
            'web_template_ids'        => ['array'],
            'web_template_ids.*'      => ['integer'],
        ],
        'SYNC_USER_NOTIFICATION_SETTING' => [
            'email_template_ids'      => ['array'],
            'email_template_ids.*'    => ['integer'],
            'mobile_template_ids'     => ['array'],
            'mobile_template_ids.*'   => ['integer'],
            'web_enable'        => ['array'],
            'web_enable.*'      => ['integer'],
        ],
    ];
}
