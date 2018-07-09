<?php

namespace App\Response\Publication;

use App\Entity\Publication;
use App\Response\Channel\ChannelTransformer;
use App\Response\Post\PostTransformer;
use App\Response\TransformCollectionTrait;
use League\Fractal\TransformerAbstract;

class PublicationTransformer extends TransformerAbstract
{
	use TransformCollectionTrait;

	public function transform(Publication $publication): array
	{
		return [
			'id' => $publication->getId(),
			'channel' => $publication->getChannel() ? (new ChannelTransformer())->transform($publication->getChannel()) : null,
			'success' => $publication->getSuccess(),
			'facebook_id' => $publication->getFacebookId(),
			'error_message' => $publication->getErrorMessage(),
			'created_at' => $publication->getCreatedAt()->format(\DateTime::ISO8601),
			'updated_at' => $publication->getUpdatedAt()->format(\DateTime::ISO8601)
		];
	}
}