<?php

namespace App\Repository;

use App\Entity\Theme;
use Computools\CLightORM\Repository\AbstractRepository;

class ThemeRepository extends AbstractRepository
{
	public function getEntityClass(): string
	{
		return Theme::class;
	}
}