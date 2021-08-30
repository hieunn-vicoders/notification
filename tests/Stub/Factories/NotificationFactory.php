<?php 

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use VCComponent\Laravel\Notification\Test\Stub\Entities\Notification;

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

$factory->define(Notification::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => Str::slug($faker->name),
        'email_template' => $faker->paragraph(),
        'mobile_template' => $faker->paragraph(),
        'web_template' => $faker->paragraph(),
    ];
});
