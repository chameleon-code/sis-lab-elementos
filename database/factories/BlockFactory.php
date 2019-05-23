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

$factory->define(App\Block::class, function (Faker\Generator $faker) {
    $management = App\Management::all()->random();
    $name = 'Bloque-'.$faker->randomElement([
        '1','2','3','4','5','6','7','8','9'
        //'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
    ]).'-'.$faker->randomElement([
        '1','2','3','4','5','6','7','8','9'
        //'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
    ]);
    $block_path = $management->management_path.'/'.$name;

    return [
        'management_id' => $management->id,
        'name' => $name,
        'block_path' => $block_path,
    ];
});

$factory->define(App\BlockGroup::class, function (Faker\Generator $faker) {

    return [
        'block_id' => App\Block::all()->random()->id,
        'group_id' => App\Group::all()->random()->id,
    ];
});