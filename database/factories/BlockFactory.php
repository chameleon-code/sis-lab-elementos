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
    $block = App\Block::all()->random();
    $groups = App\Group::all();
    $groups_size = 0;
    foreach($groups as $group){
        $groups_size++;
    }
    $groups_id = [];
    for($i=1 ; $i<=$groups_size ; $i++){
        $groups_id[$i] = $i;
    }

    return [
        'block_id' => $block->id,
        'group_id' => $faker->unique()->randomElement($groups_id)
    ];
});