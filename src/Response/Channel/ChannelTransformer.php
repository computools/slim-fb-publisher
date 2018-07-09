<?php

namespace App\Response\Channel;

use App\Entity\Channel;
use League\Fractal\TransformerAbstract;

class ChannelTransformer extends TransformerAbstract
{
	public function transform(Channel $channel): array
	{
		return [
			'id' => $channel->getId(),
			'facebook_id' => $channel->getFacebookId(),
			'expires_at' => $channel->getExpiresAt() ? $channel->getExpiresAt()->format(\DateTime::ISO8601): null,
			'created_at' => $channel->getCreatedAt() ? $channel->getCreatedAt()->format(\DateTime::ISO8601): null,
			'updated_at' => $channel->getUpdatedAt() ? $channel->getUpdatedAt()->format(\DateTime::ISO8601): null,
		];
	}
}