<?php

namespace VCComponent\Laravel\Notification\Test\Stub\Entities;

use Illuminate\Notifications\Notifiable;
use VCComponent\Laravel\User\Entities\User as EntitiesUser;

class User extends EntitiesUser{

    use Notifiable;
}