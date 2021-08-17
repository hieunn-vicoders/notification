<?php

namespace VCComponent\Laravel\Notification\Test\Stub\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model{

    use Notifiable;
}