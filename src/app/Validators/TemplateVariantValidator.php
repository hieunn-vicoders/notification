<?php

namespace VCComponent\Laravel\Notification\Validators;

use VCComponent\Laravel\Vicoders\Core\Validators\AbstractValidator;
use VCComponent\Laravel\Vicoders\Core\Validators\ValidatorInterface;

class TemplateVariantValidator extends AbstractValidator
{
    protected $rules = [
        ValidatorInterface::RULE_ADMIN_CREATE => [
            'variable'   => ['required', 'max:255'],
            'notification_id'   => ['required', 'integer'],
        ],
        ValidatorInterface::RULE_ADMIN_UPDATE => [
            'variable'   => ['required', 'max:255'],
            'notification_id'   => ['required', 'integer'],
        ],
    ];
}
