<?php

namespace App\Repository;

use App\Entity\Theme;
use Computools\LessqlORM\Repository\AbstractRepository;

class ThemeRepository extends AbstractRepository
{
	public function getEntityClass(): string
	{
		return Theme::class;
	}
}