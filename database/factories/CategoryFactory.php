<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $user = factory(App\User::class)->create();
    return [
        'name'=>$faker->name,
        'user_id'=>$user->id
    ];
});
