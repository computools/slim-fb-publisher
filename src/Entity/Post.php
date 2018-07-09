<?php

namespace App\Entity;

use Computools\LessqlORM\Entity\TimestampsTrait;
use Computools\LessqlORM\Mapper\MapperInterface;
use App\Mapper\PostMapper;
use Computools\LessqlORM\Entity\AbstractEntity;

class Post extends AbstractEntity
{
	use TimestampsTrait;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getMapper(): MapperInterface
	{
		return new PostMapper();
	}

	private $id;

	private $title;

	private $content;

	private $user;

	/**
	 * @var Theme[]
	 */
	private $themes = [];

	/**
	 * @var Publication[]
	 */
	private $publications = [];

	public function getTitle(): string
	{
		return $this->title;
	}

	public function setTitle(string $title): void
	{
		$this->title = $title;
	}

	public function setId(?int $id): void
	{
		$this->id = $id;
	}

	public function getContent(): string
	{
		return $this->content;
	}

	public function setContent(string $content)
	{
		$this->content = $content;
	}

	public function getUser(): ?User
	{
		return $this->user;
	}

	public function setUser(?User $user)
	{
		$this->user = $user;
	}

	public function getThemes()
	{
		return $this->themes;
	}

	public function setThemes($themes)
	{
		$this->themes = $themes;
	}

	public function getPublications(): ?array
	{
		return $this->publications;
	}

	public function setPublications(?array $publications)
	{
		$this->publications = $publications;
	}
}