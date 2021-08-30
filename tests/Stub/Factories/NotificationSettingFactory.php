<?php 

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use VCComponent\Laravel\Notification\Test\Stub\Entities\NotificationSetting;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(NotificationSetting::class, function (Faker $faker) {
    return [
        'notification_id' => rand(1, 10),
        'notificationable_id' => rand(1, 10),
        'email_enable' => rand(0,1),
        'mobile_enable' => rand(0,1),
        'web_enable' => rand(0,1),
    ];
});

