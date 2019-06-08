<?php
use Illuminate\Support\Facades\Storage;
use App\Professor;

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
    $professors = Professor::join('users', 'user_id', '=', 'users.id')->select('users.role_id', 'users.names', 'users.first_name', 'users.second_name', 'users.email', 'users.password', 'users.img_path', 'users.code_sis', 'professors.id')->get();
    $user = $faker->randomElement($professors);
    $title = $faker->sentence(5, true);
    $description = $faker->text(400);

    return [
        'sesion_id' => $sesion_id,
        'title' => $title,
        'published_by' => $user->names.' '.$user->first_name,
        'description' => $description,
    ];
});