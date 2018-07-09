<?php

namespace App\Response\Post;

use App\Entity\Post;
use App\Response\Publication\PublicationTransformer;
use App\Response\Theme\ThemeTransformer;
use League\Fractal\TransformerAbstract;

class SinglePostTransformer extends TransformerAbstract
{
	public function transform(Post $post): array
	{
		return [
			'id' => $post->getId(),
			'title' => $post->getTitle(),
			'content' => $post->getContent(),
			'created_at' => $post->getCreatedAt() ? $post->getCreatedAt()->format(\DateTime::ISO8601) : null,
			'updated_at' => $post->getUpdatedAt() ? $post->getUpdatedAt()->format(\DateTime::ISO8601) : null,
			'themes' => $post->getThemes() ? (new ThemeTransformer())->transformCollection($post->getThemes()) : [],
			'publications' => $post->getPublications() ? (new PublicationTransformer())->transformCollection($post->getPublications()) : []
		];
	}
}