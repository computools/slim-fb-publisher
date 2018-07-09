<?php

namespace App\Mapper;

use App\Entity\User;
use Computools\LessqlORM\Mapper\Mapper;
use Computools\LessqlORM\Mapper\Relations\ManyToOne;
use Computools\LessqlORM\Mapper\Types\CreatedAtType;
use Computools\LessqlORM\Mapper\Types\DateTimeType;
use Computools\LessqlORM\Mapper\Types\IdType;
use Computools\LessqlORM\Mapper\Types\StringType;
use Computools\LessqlORM\Mapper\Types\UpdatedAtType;

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