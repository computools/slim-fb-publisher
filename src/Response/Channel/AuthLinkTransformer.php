<?php

namespace App\Response\Channel;

use League\Fractal\TransformerAbstract;

class AuthLinkTransformer extends TransformerAbstract
{
	public function transform(string $link): array
	{
		return [
			'link' => $link
		];
	}
}