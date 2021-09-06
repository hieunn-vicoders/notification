<?php

namespace VCComponent\Laravel\Notification\Validators;

use VCComponent\Laravel\Vicoders\Core\Validators\AbstractValidator;
use VCComponent\Laravel\Vicoders\Core\Validators\ValidatorInterface;

class NotificationValidator extends AbstractValidator
{
    protected $rules = [
        ValidatorInterface::RULE_ADMIN_CREATE => [
            'name'   => ['required', 'max:255'],
            'slug'   => ['required', 'max:255', 'unique:notifications'],
        ],
        ValidatorInterface::RULE_ADMIN_UPDATE => [
            'name'   => ['required', 'max:255'],
            'slug'   => ['required', 'max:255', 'unique:notifications'],
        ],
    ];
}
