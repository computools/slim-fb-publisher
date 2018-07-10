<?php

namespace App\Mapper;

use App\Entity\Channel;
use App\Entity\Post;
use Computools\CLightORM\Mapper\Mapper;
use Computools\CLightORM\Mapper\Relations\ManyToOne;
use Computools\CLightORM\Mapper\Types\BooleanType;
use Computools\CLightORM\Mapper\Types\CreatedAtType;
use Computools\CLightORM\Mapper\Types\IdType;
use Computools\CLightORM\Mapper\Types\UpdatedAtType;
use Computools\CLightORM\Mapper\Types\StringType;

class PublicationMapper extends Mapper
{
	public function getTable(): string
	{
		return 'publication';
	}

	public function getFields(): array
	{
		return [
			'id' => new IdType(),
			'channel' => new ManyToOne(new Channel(), 'channel_id'),
			'post' => new ManyToOne(new Post(), 'post_id'),
			'success' => new BooleanType(),
			'facebook_id' => new StringType(),
			'error_message' => new StringType(),
			'created_at' => new CreatedAtType(),
			'updated_at' => new UpdatedAtType()
		];
	}
}