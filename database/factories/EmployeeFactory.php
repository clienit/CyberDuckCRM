<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Employee;
use App\Model\Company;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'company_id' => function() {
            return factory(Company::class)->create()->id;
        },
        'email' => $faker->unique()->email,
        'phone' => $faker->phoneNumber,
    ];
});
