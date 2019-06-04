<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Group::class, function (Faker\Generator $faker) {
    $name = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21];

    return [
        'name' => $faker->randomElement($name),
        'subject_matter_id' => \App\SubjectMatter::all()->random()->id,
        'professor_id' => \App\Professor::all()->random()->id,
    ];
});