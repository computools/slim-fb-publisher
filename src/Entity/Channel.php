<?php

namespace App\Entity;

use App\Mapper\ChannelMapper;
use Computools\LessqlORM\Entity\AbstractEntity;
use Computools\LessqlORM\Entity\TimestampsTrait;
use Computools\LessqlORM\Mapper\MapperInterface;

class Channel extends AbstractEntity
{
	use TimestampsTrait;

	public function getMapper(): MapperInterface
	{
		return new ChannelMapper();
	}

	private $id;

	private $user;

	private $facebookId;

	private $accessToken;

	private $expiresAt;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function setId(?int $id): void
	{
		$this->id = $id;
	}

	public function getUser(): ?User
	{
		return $this->user;
	}

	public function setUser(?User $user)
	{
		$this->user = $user;
	}

	public function getFacebookId(): ?string
	{
		return $this->facebookId;
	}

	public function setFacebookId(?string $facebookId)
	{
		$this->facebookId = $facebookId;
	}

	public function getAccessToken(): ?string
	{
		return $this->accessToken;
	}

	public function setAccessToken(?string $accessToken)
	{
		$this->accessToken = $accessToken;
	}

	public function getExpiresAt(): ?\DateTime
	{
		return $this->expiresAt;
	}

	public function setExpiresAt(?\DateTime $expiresAt)
	{
		$this->expiresAt = $expiresAt;
	}
}
