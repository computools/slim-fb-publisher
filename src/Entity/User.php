<?php

namespace App\Entity;

use Computools\CLightORM\Entity\TimestampsTrait;
use Computools\CLightORM\Mapper\MapperInterface;
use App\Mapper\UserMapper;
use Computools\CLightORM\Entity\AbstractEntity;

class User extends AbstractEntity
{
	use TimestampsTrait;

	public function getMapper(): MapperInterface
	{
		return new UserMapper();
	}

	private $id;

	private $email;

	private $password;

	private $posts = [];

	public function getId(): ?int
	{
		return $this->id;
	}

	public function setId(?int $id): void
	{
		$this->id = $id;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getPosts(): ?array
	{
		return $this->posts;
	}

	public function setPosts(?array $posts): void
	{
		$this->posts = $posts;
	}
}