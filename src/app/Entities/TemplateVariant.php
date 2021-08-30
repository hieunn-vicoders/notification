<?php

namespace VCComponent\Laravel\Notification\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TemplateVariant extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'variable',
        'notification_id'
    ];

    public function notification() {
        return $this->belongsTo(Notification::class, 'notification_id', 'id');
    }
}
