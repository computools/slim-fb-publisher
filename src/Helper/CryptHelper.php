<?php

namespace App\Helper;

class CryptHelper
{
	const COST = 10;

	public static function hash($password)
	{
		return password_hash($password, PASSWORD_BCRYPT, [
			'cost' => 10
		]);
	}

	public static function verify($pasword, $hash)
	{
		return password_verify($pasword, $hash);
	}
}