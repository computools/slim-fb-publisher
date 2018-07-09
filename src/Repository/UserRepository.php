<?php

namespace App\Repository;

use App\Entity\User;
use Computools\LessqlORM\Repository\AbstractRepository;

class UserRepository extends AbstractRepository
{
	public function getEntityClass(): string
	{
		return User::class;
	}
}