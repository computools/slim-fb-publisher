<?php

namespace App\Helper;

use Firebase\JWT\JWT;

class TokenHelper
{
	public static function createToken(int $userId, string $email, array $settings)
	{
		$now = time();
		$expires = $now + $settings['expires'];

		return [
			'token' => JWT::encode([
					'user' => $userId,
					'email' => $email,
					'iat' => $now,
					'exp' => $expires
				], $settings['secret']),
			'expires' => $expires
		];
	}
}