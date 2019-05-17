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

$factory->define(App\SubjectMatter::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->randomElement(
            [
                'Introducción a la Programación',
                'Circuitos',
                'Taller de Sistemas Operativos',
                'Base de Datos I',
                'Elementos de Programación y Estructura de Datos',
                'Redes de Computadoras',
            ]
        ),
    ];
});