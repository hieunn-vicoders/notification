<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use VCComponent\Laravel\Notification\Test\Stub\Entities\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'slug'        => Str::slug($faker->name),  
    ];
});
