<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	const USER_VERIFIED = '1';
	const USER_NOT_VERIFIED = '0';

	const USER_ADMIN = 'true';
	const USER_REGULAR = 'false';

	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'verified',
		'verification_token',
		'admin',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
		'verification_token',
	];

	//El usuario esta verificado
	public function isVerified() {
		return $this->verified == User::USER_VERIFIED;
	}

	//El usuario es administrador
	public function isAdmin() {
		return $this->admin == User::USER_ADMIN;
	}

	//Generar token de verificación
	public static function generateVerificationToken() {
		return str_random(40);
	}
}
