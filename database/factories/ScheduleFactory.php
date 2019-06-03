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

$factory->define(App\Hour::class, function (Faker\Generator $faker) {
    return [
        'start' => '00:00:00',
        'end' => '00:00:00',
    ];
});

$factory->define(App\Day::class, function (Faker\Generator $faker) {
    return [
        'name' => '',
    ];
});

$factory->define(App\ScheduleRecord::class, function (Faker\Generator $faker) {
    $lab_id = $faker->randomElement(App\Laboratory::all())->id;
    $day_id = $faker->randomElement(App\Day::all())->id;
    $hour_id = $faker->randomElement(App\Hour::all())->id;

    return [
        'laboratory_id' => $lab_id,
        'day_id' => $day_id,
        'hour_id' => $hour_id,
    ];
});