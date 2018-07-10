<?php

namespace App\Repository;

use App\Entity\User;
use Computools\CLightORM\Repository\AbstractRepository;

class UserRepository extends AbstractRepository
{
	public function getEntityClass(): string
	{
		return User::class;
	}
}