<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BotSpeak;
use Faker\Generator as Faker;

$factory->define(BotSpeak::class, function (Faker $faker) {
    return [
        'command'=> $faker->word,
        'content'=> $faker->sentence,
    ];
});
