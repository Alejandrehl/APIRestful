<?php
use App\Buyer;
use App\Category;
use App\Product;
use App\Seller;
use App\Transaction;
use App\User;

$factory->define(App\User::class, function (Faker\Generator $faker) {
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
		'verified' => $verificated = $faker->randomElement([User::USER_VERIFIED, User::USER_NOT_VERIFIED]),
		'verification_token' => $verificated == User::USER_VERIFIED ? null : User::generateVerificationToken(),
		'admin' => $faker->randomElement([User::USER_REGULAR, User::USER_ADMIN]),
	];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {

	return [
		'name' => $faker->word,
		'description' => $faker->paragraph(1),
	];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {

	return [
		'name' => $faker->word,
		'description' => $faker->paragraph(1),
		'quantity' => $faker->numberBetween(1, 10),
		'status' => $faker->randomElement([Product::PRODUCT_AVAILABLE, Product::PRODUCT_NOT_AVAILABLE]),
		'image' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg']),
		'seller_id' => User::all()->random()->id,
	];
});

$factory->define(App\Transaction::class, function (Faker\Generator $faker) {

	$seller = Seller::has('products')->get()->random();
	$buyer = Buyer::all()->except($seller->id)->random();

	return [
		'quantity' => $faker->numberBetween(1, 3),
		'buyer_id' => $buyer->id,
		'product_id' => $seller->products->random()->id,
	];
});