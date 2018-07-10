<?php

namespace App\Entity;

use App\Mapper\PublicationMapper;
use Computools\CLightORM\Entity\AbstractEntity;
use Computools\CLightORM\Entity\TimestampsTrait;
use Computools\CLightORM\Mapper\MapperInterface;

class Publication extends AbstractEntity
{
	use TimestampsTrait;

	public function getMapper(): MapperInterface
	{
		return new PublicationMapper();
	}

	private $id;

	private $post;

	private $channel;

	private $success;

	private $facebookId;

	private $errorMessage;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function setId(?int $id): void
	{
		$this->id = $id;
	}

	public function getPost(): ?Post
	{
		return $this->post;
	}

	public function setPost(?Post $post)
	{
		$this->post = $post;
	}

	public function getChannel(): ?Channel
	{
		return $this->channel;
	}

	public function setChannel(Channel $channel)
	{
		$this->channel = $channel;
	}

	public function getSuccess(): bool
	{
		return $this->success;
	}

	public function setSuccess(bool $success)
	{
		$this->success = $success;
	}

	public function getFacebookId(): ?string
	{
		return $this->facebookId;
	}

	public function setFacebookId(?string $facebookId)
	{
		$this->facebookId = $facebookId;
	}

	public function getErrorMessage(): ?string
	{
		return $this->errorMessage;
	}

	public function setErrorMessage(?string $errorMessage)
	{
		$this->errorMessage = $errorMessage;
	}
}