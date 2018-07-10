<?php

namespace App\Repository;

use App\Entity\Channel;
use Computools\CLightORM\Repository\AbstractRepository;

class ChannelRepository extends AbstractRepository
{
	public function getEntityClass(): string
	{
		return Channel::class;
	}
}