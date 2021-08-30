<?php

namespace VCComponent\Laravel\Notification\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use VCComponent\Laravel\User\Entities\UserHasRole;

class Notification extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'slug',
        'email_template',
        'mobile_template',
        'web_template',
    ];

    public function templateVariants() {
        return $this->hasMany(TemplateVariant::class);
    }
}
