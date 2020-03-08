<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    $picture='image'.(rand()%3).'png';
    $department = factory(App\Models\Department::class)->create();
    $category = factory(App\Models\Category::class)->create();
    $user = factory(App\User::class)->create();
    return [
        'user_id'=>$user->id,
        'category_id'=>$category->id,
        'department_id'=>$department->id,
        'title'=>$faker->name,
        'picture'=>$picture
    ];
});
