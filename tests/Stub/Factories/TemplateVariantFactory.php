<?php 

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use VCComponent\Laravel\Notification\Test\Stub\Entities\TemplateVariant;

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

$factory->define(TemplateVariant::class, function (Faker $faker) {
    return [
        'variable' => $faker->name,
        'notification_id' => rand(1, 9),
    ];
});
