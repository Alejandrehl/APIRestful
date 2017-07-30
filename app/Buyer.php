<?php

namespace App;

use App\Transaction;

class Buyer extends User {

	//Un comprador tiene muchas transacciones
	public function transactions() {
		return $this->hasMany(Transaction::class);
	}
}