<?php

namespace App\Entity;

use Computools\LessqlORM\Entity\AbstractEntity;
use Computools\LessqlORM\Entity\TimestampsTrait;
use Computools\LessqlORM\Mapper\MapperInterface;
use App\Mapper\ThemeMapper;

class Theme extends AbstractEntity
{
	use TimestampsTrait;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getMapper(): MapperInterface
	{
		return new ThemeMapper();
	}

	private $id;

	private $title;

	private $user;

	private $posts = [];

	public function setId(?int $id): void
	{
		$this->id = $id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle(string $title)
	{
		$this->title = $title;
	}

	public function getPosts(): ?array
	{
		return $this->posts;
	}

	public function setPosts(?array $posts)
	{
		$this->posts = $posts;
	}

	public function getUser(): ?User
	{
		return $this->user;
	}

	public function setUser(?User $user)
	{
		$this->user = $user;
	}
}