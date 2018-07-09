<?php

namespace App\Response\Theme;

use App\Entity\Theme;
use App\Response\Post\PostTransformer;
use App\Response\TransformCollectionTrait;
use League\Fractal\TransformerAbstract;

class ThemeTransformer extends TransformerAbstract
{
	use TransformCollectionTrait;

	public function transform(Theme $theme): array
	{
		return [
			'id' => $theme->getId(),
			'title' => $theme->getTitle(),
			'created_at' => $theme->getCreatedAt()->format(\DateTime::ISO8601),
			'updated_at' => $theme->getUpdatedAt() ? $theme->getUpdatedAt()->format(\DateTime::ISO8601) : null
		];
	}
}