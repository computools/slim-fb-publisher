<?php

namespace App\Mapper;

use App\Entity\User;
use Computools\CLightORM\Mapper\Mapper;
use Computools\CLightORM\Mapper\Relations\ManyToOne;
use Computools\CLightORM\Mapper\Types\CreatedAtType;
use Computools\CLightORM\Mapper\Types\DateTimeType;
use Computools\CLightORM\Mapper\Types\IdType;
use Computools\CLightORM\Mapper\Types\StringType;
use Computools\CLightORM\Mapper\Types\UpdatedAtType;

class ChannelMapper extends Mapper
{
	public function getTable(): string
	{
		return 'channel';
	}

	public function getFields(): array
	{
		return [
			'id' => new IdType(),
			'user' => new ManyToOne(new User(), 'user_id'),
			'facebook_id' => new StringType(),
			'access_token' => new StringType(),
			'created_at' => new CreatedAtType(),
			'updated_at' => new UpdatedAtType(),
			'expires_at' => new DateTimeType()
		];
	}
}