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
    return [
        'name' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
        'subject_matter_id' => \App\SubjectMatter::all()->random()->id,
        'professor_id' => \App\Professor::all()->random()->id,
    ];
});