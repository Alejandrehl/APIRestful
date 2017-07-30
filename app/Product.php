<?php

namespace App;

use App\Category;
use App\Seller;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
	const PRODUCT_AVAILABLE = 'Available';
	const PRODUCT_NOT_AVAILABLE = 'Not Available';

	protected $fillable = [
		'name',
		'description',
		'quantity',
		'status',
		'image',
		'seller_id',
	];

	//Un producto tiene muchas categorías
	public function categories() {
		return $this->belongsToMany(Category::class);
	}

	//Un producto pertenece a un vendedor
	public function seller() {
		return $this->belongsTo(Seller::class);
	}

	//Un producto tiene muchas transacciones
	public function transactions() {
		return $this->hasMany(Transaction::class);
	}

	//El producto esta disponible
	public function isAvailable() {
		return $this->status == Product::PRODUCT_AVAILABLE;
	}
}
