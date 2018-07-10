<?php

namespace App\Mapper;

use Computools\CLightORM\Mapper\Relations\OneToMany;
use App\Entity\Post;
use Computools\CLightORM\Mapper\Mapper;
use Computools\CLightORM\Mapper\Types\CreatedAtType;
use Computools\CLightORM\Mapper\Types\IdType;
use Computools\CLightORM\Mapper\Types\UpdatedAtType;
use Computools\CLightORM\Mapper\Types\StringType;

class UserMapper extends Mapper
{
	public function getTable(): string
	{
		return 'users';
	}

	public function getFields(): array
	{
		return [
			'id' => new IdType(),
			'email' => new StringType(),
			'password' => new StringType(),
			'created_at' => new CreatedAtType(),
			'updated_at' => new UpdatedAtType(),
			'posts' => new OneToMany(new Post(), 'user_id')
		];
	}
}