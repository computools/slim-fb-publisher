<?php

namespace App\Response\Post;

use App\Entity\Post;
use App\Response\Publication\PublicationTransformer;
use App\Response\TransformCollectionTrait;
use League\Fractal\TransformerAbstract;
use App\Response\Theme\ThemeTransformer;

class PostTransformer extends TransformerAbstract
{
	use TransformCollectionTrait;

	public function transform(Post $post): array
	{
		return [
			'id' => $post->getId(),
			'title' => $post->getTitle(),
			'created_at' => $post->getCreatedAt() ? $post->getCreatedAt()->format(\DateTime::ISO8601) : null,
			'updated_at' => $post->getUpdatedAt() ? $post->getUpdatedAt()->format(\DateTime::ISO8601) : null,
			'themes' => $post->getThemes() ? (new ThemeTransformer())->transformCollection($post->getThemes()) : [],
			'publications' => $post->getPublications() ? (new PublicationTransformer())->transformCollection($post->getPublications()) : null
		];
	}
}