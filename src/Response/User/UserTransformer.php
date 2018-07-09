<?php

namespace App\Response\User;

use App\Entity\User;
use App\Response\Post\PostTransformer;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	public function transform(User $user): array
	{
		return [
			'id' => $user->getId(),
			'email' => $user->getEmail(),
			'created_at' => $user->getCreatedAt()->format(\DateTime::ISO8601),
			'updated_at' => $user->getUpdatedAt() ? $user->getUpdatedAt()->format(\DateTime::ISO8601) : null,
			'posts' => count($user->getPosts()) ? (new PostTransformer())->transformCollection($user->getPosts()) : []
		];
	}
}