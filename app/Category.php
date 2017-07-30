<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	protected $fillable = [
		'name',
		'description',
	];

	//Una categoría tiene muchos productos
	public function products() {
		return $this->belongsToMany(Product::class);
	}
}