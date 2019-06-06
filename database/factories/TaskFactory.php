<?php
use Illuminate\Support\Facades\Storage;

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

$factory->define(App\Task::class, function (Faker\Generator $faker) {
    $sesion_id = $faker->randomElement(App\Sesion::all())->id;
    
    $title = $faker->sentence(5, true);
    $description = $faker->text(400);

    return [
        'sesion_id' => $sesion_id,
        'title' => $title,
        'description' => $description,
    ];
});