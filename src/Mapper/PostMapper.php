<?php

namespace App\Mapper;

use App\Entity\Publication;
use App\Entity\Theme;
use App\Entity\User;
use Computools\LessqlORM\Mapper\Mapper;
use Computools\LessqlORM\Mapper\Relations\ManyToMany;
use Computools\LessqlORM\Mapper\Relations\ManyToOne;
use Computools\LessqlORM\Mapper\Relations\OneToMany;
use Computools\LessqlORM\Mapper\Types\CreatedAtType;
use Computools\LessqlORM\Mapper\Types\IdType;
use Computools\LessqlORM\Mapper\Types\UpdatedAtType;
use Computools\LessqlORM\Mapper\Types\StringType;

class PostMapper extends Mapper
{
	public function getTable(): string
	{
		return 'post';
	}

	public function getFields(): array
	{
		return [
			'id' => new IdType(),
			'title' => new StringType(),
			'content' => new StringType(),
			'created_at' => new CreatedAtType(),
			'updated_at' => new UpdatedAtType(),
			'user' => new ManyToOne(new User(), 'user_id'),
			'themes' => new ManyToMany(new Theme(), 'post_theme', 'post_id','theme_id'),
			'publications' => new OneToMany(new Publication(), 'post_id'),
		];
	}
}