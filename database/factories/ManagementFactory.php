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

$factory->define(App\Management::class, function (Faker\Generator $faker) {
    $semester = $faker->unique()->randomElement(['1', '2']);
    $management = 2019;
    $start_management = $semester == '1' ? '2019-02-01' : '2019-07-01';
    $end_management = $semester == '1' ? '2019-06-30' : '2019-11-30';
    $management_path = 'folders/'.$management.'-'.$semester;
    
    return [
        'semester' => $semester,
        'managements' => $management,
        'start_management' => $start_management,
        'end_management' => $end_management,
        'management_path' => $management_path,
    ];
});