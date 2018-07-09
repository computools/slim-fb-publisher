<?php

namespace App\Response\Token;

use League\Fractal\TransformerAbstract;

class TokenTransformer extends TransformerAbstract
{
	public function transform(array $token): array
	{
		return [
			'token' => $token['token'],
			'expires' => $token['expires']
		];
	}
}