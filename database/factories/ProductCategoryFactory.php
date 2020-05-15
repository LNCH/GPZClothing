<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Products\Category;
use Faker\Generator as Faker;

$statuses = array_keys(Category::STATUSES);

$factory->define(Category::class, function (Faker $faker) use ($statuses) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'status' => $statuses[random_int(0, count($statuses) - 1)]
    ];
});
