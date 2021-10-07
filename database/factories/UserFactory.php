<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use ApiWebPsp\Models\Address;
use ApiWebPsp\Models\Receiver;
use ApiWebPsp\Models\ReceiverContact;
use ApiWebPsp\Models\SolicitationItem;
use ApiWebPsp\Models\Company;
use ApiWebPsp\Models\Product;
use ApiWebPsp\Models\Solicitation;
use ApiWebPsp\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Company::class, function (Faker $faker){

});

$factory->define(Address::class, function (Faker $faker){
    return [
        'alias' => 'casa',
        'street' => $faker->streetName,
        'number' => $faker->numberBetween(0,100),
        'complement' => $faker->word,
        'neighborhood' => $faker->word,
        'postal_code' => $faker->postcode,
        'reference' => $faker->locale,
        'city' => $faker->city,
        'uf' => 'SP'
    ];
});
$factory->define(Product::class, function (Faker $faker){

});

$factory->define(SolicitationItem::class, function (Faker $faker){
    return [
        'product_id' => rand(1,5),
        'qtd' => 2,
        'price_unitary' => 50,
        'lot' => 'LT555',
        'pen' => 'sim',
        'expiration_date' => '2025-04-30'
    ];
});

$factory->define(Receiver::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'document' => $faker->numerify('###.###.###-##'),
        'genre' => 'masculino',
        'date_birth' => $faker->date()
    ];
});

$factory->define(\ApiWebPsp\Models\AuthorizedPerson::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'document' => $faker->numerify('###.###.###-##'),
        'phone' =>  $faker->numerify('(##) ####-######')
    ];
});

$factory->define(ReceiverContact::class, function (Faker $faker) {
    return [
        'content' => $faker->email,
        'type' => 'email',
        'principal' => $faker->boolean
    ];
});

$factory->define(Solicitation::class, function (Faker $faker){
    return [
        'id' =>\Faker\Provider\Uuid::uuid(),
        'receiver_id' => rand(1,10),
        'status' => 'aberto',
        'voucher' => $faker->numerify('###A###X###E##')
    ];
});
