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

$factory->define(App\User::class, function (Faker\Generator $faker) {

    $satuan = ['KG', 'LTR', 'ONS'];
    $user = ['admin', 'Armand', 'Iskandar', 'Eli'];

    // make sure the property same as the model
    return [
        'nomor_barang' => $faker->randomNumber(4) .'.'. $faker->randomNumber(4),
        'nama_barang' => $faker->name,
        'satuan' => $faker->randomElement($satuan),
        'kuantitas' => $faker->randomNumber(2),
        'harga_satuan' => $faker->randomNumber(5),
        'dibuat_oleh' => $faker->randomElement($user),
    ];
});

//
