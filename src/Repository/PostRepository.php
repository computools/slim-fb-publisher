<?php

namespace App\Repository;

use App\Entity\Post;
use App\Entity\User;
use Computools\LessqlORM\Repository\AbstractRepository;
use Computools\LessqlORM\Tools\Pagination;

class PostRepository extends AbstractRepository
{
	public function getEntityClass(): string
	{
		return Post::class;
	}

	public function findByUser(User $user, $with = [], ?Pagination $pagination = null): array
	{
		return $this->findBy([
			'user_id' => $user->getId()
		], $with, $pagination);
	}
}