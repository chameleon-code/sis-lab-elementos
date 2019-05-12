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
$factory->define(App\Role::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $names = $faker->name;
    $first_name = $faker->LastName;
    $second_name = $faker->LastName;
    $code_sis = $faker->unique()->randomNumber(8);
    return [
        'names' => $names,
        'first_name' => $first_name,
        'second_name' => $second_name,
        'role_id' => \App\Role::all()->random()->id,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'code_sis' => $code_sis,
       // 'img_path' => \Faker\Provider\Image::image(storage_path() . '/app/public/users', 200, 200, 'people', false),
    ];
});

$factory->define(App\Admin::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'user_id' => null,
    ];
});

$factory->define(App\Professor::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'user_id' => null,
    ];
});

$factory->define(App\Auxiliar::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'user_id' => null,
        'type' => null
    ];
});

$factory->define(App\Student::class, function (Faker\Generator $faker) {
    static $password;
    $ci = $faker->randomNumber();
    return [
        'user_id' => null,
        'ci' => $ci,
        'block_id' => null,
        'student_path' => null,
    ];
});

$factory->define(App\Management::class, function (Faker\Generator $faker) {
    static $semester;
    static $managements;
    static $start_management;
    static $end_management;
    
    return [
        'semester' => $semester,
        'managements' => $managements,
        'start_management' => $start_management,
        'end_management' => $end_management,
        'management_path' => null,
    ];
});

$factory->define(App\SubjectMatter::class, function (Faker\Generator $faker) {
    static $name;
    
    return [
        'name' => $name
    ];
});