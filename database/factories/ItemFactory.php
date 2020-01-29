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

$factory->define(App\Items::class, function (Faker\Generator $faker) {

    $menu = ['Ramen', 'Noodle', 'Junk Food', 'Fast Food'];
    $name = $faker->name;
    $img = $name.'.jpg';
    $itemid = substr($name, 0, 3);
    $itemid = str_pad($itemid, 7, "0", STR_PAD_RIGHT);

    // make sure the property same as the model
    return [
        'item_id'=>$itemid,
        'item_img_name' => $img,
        'item_name' => $name,
        'menu_id' => $faker->randomElement($menu),
        'price' => $faker->randomNumber(2),
        'show' => $faker->boolean,
        'out_of_stock' => $faker->boolean,
    ];
});

//
