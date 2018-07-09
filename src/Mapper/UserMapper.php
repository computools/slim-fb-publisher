<?php

namespace App\Mapper;

use Computools\LessqlORM\Mapper\Relations\OneToMany;
use App\Entity\Post;
use Computools\LessqlORM\Mapper\Mapper;
use Computools\LessqlORM\Mapper\Types\CreatedAtType;
use Computools\LessqlORM\Mapper\Types\IdType;
use Computools\LessqlORM\Mapper\Types\UpdatedAtType;
use Computools\LessqlORM\Mapper\Types\StringType;

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