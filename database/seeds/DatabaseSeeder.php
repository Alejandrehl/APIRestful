<?php
use App\Category;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		User::truncate();
		Category::truncate();
		Product::truncate();
		Transaction::truncate();
		DB::table('category_product')->truncate();

		$quantityUsers = 200;
		$quantityCategories = 30;
		$quantityProducts = 1000;
		$quantityTransactions = 1000;

		factory(User::class, $quantityUsers)->create();
		factory(Category::class, $quantityCategories)->create();
		factory(Product::class, $quantityProducts)->create()->each(
			function ($product) {
				$categories = Category::all()->random(mt_rand(1, 5))->pluck('id');
				$product->categories()->attach($categories);
			}
		);
		factory(Transaction::class, $quantityTransactions)->create();

	}
}
