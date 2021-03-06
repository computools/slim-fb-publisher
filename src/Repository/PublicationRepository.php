<?php

namespace App\Repository;

use App\Entity\Publication;
use Computools\CLightORM\Repository\AbstractRepository;

class PublicationRepository extends AbstractRepository
{
	public function getEntityClass(): string
	{
		return Publication::class;
	}
}