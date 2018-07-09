<?php

namespace App\Action;

use App\Entity\User;
use App\Exception\User\InvalidCredentialsException;
use App\Service\FacebookService;
use Computools\LessqlORM\Repository\RepositoryInterface;
use App\Repository\UserRepository;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\TransformerAbstract;
use LessQL\Database;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class ApiAction
{
	/**
	 * @var Database
	 */
	private $db;

	/**
	 * @var User
	 */
	private $user = null;

	/**
	 * @var Request $request
	 */
	private $request;

	/**
	 * @var Response $response
	 */
	private $response;

	/**
	 * @var array
	 */
	protected $args;

	/**
	 * @var ContainerInterface
	 */
	private $container;

	abstract function execute(): Response;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
		$this->db = $container->get('db');
	}

	public function __invoke(Request $request, Response $response, array $args): Response
	{
		$this->response = $response;
		$this->request = $request;
		$this->args = $args;
		if ($token = $this->request->getAttribute('token')) {
			if (!$user = $this->getRepository(UserRepository::class)->find($token['user'])) {
				throw new InvalidCredentialsException();
			}
			$this->user = $user;
		}
		return $this->execute();
	}

	public function getPathParam(string $key, $default = null): ?string
	{
		return $this->args[$key] ?? $default;
	}

	protected function response($data, int $status = 200): Response
	{
		return $this->response->withJson($data, $status);
	}

	protected function getRequest(): Request
	{
		return $this->request;
	}

	protected function getResponse(): Response
	{
		return $this->response;
	}

	protected function getContainer(): ContainerInterface
	{
		return $this->container;
	}

	protected function getRepository(string $class): RepositoryInterface
	{
		return $this->container->get('repositoryFactory')->create($class);
	}

	protected function getFacebookService(): FacebookService
	{
		return $this->getContainer()->get('facebook');
	}

	protected function getUser(): ?User
	{
		return $this->user;
	}

	protected function item($data, TransformerAbstract $transformer): array
	{
		return (new Manager())
			->setSerializer(new DataArraySerializer())
			->createData(new Item($data, $transformer))
			->toArray();
	}

	protected function collection($data, TransformerAbstract $transformer): array
	{
		return (new Manager())
			->setSerializer(new DataArraySerializer())
			->createData(new Collection($data, $transformer))
			->toArray();
	}

	protected function getDb(): Database
	{
		return $this->db;
	}

}