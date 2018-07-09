<?php

namespace App\Mapper;

use App\Entity\Post;
use App\Entity\User;
use Computools\LessqlORM\Mapper\Mapper;
use Computools\LessqlORM\Mapper\Relations\ManyToMany;
use Computools\LessqlORM\Mapper\Relations\ManyToOne;
use Computools\LessqlORM\Mapper\Types\CreatedAtType;
use Computools\LessqlORM\Mapper\Types\IdType;
use Computools\LessqlORM\Mapper\Types\UpdatedAtType;
use Computools\LessqlORM\Mapper\Types\StringType;

class ThemeMapper extends Mapper
{
	public function getTable(): string
	{
		return 'theme';
	}

	public function getFields(): array
	{
		return [
			'id' => new IdType(),
			'title' => new StringType(),
			'created_at' => new CreatedAtType(),
			'updated_at' => new UpdatedAtType(),
			'posts' => new ManyToMany(new Post(), 'post_theme', 'post_id', 'theme_id'),
			'user' => new ManyToOne(new User(), 'user_id')
		];
	}
}