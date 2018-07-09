<?php

namespace App\Exception;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class NotFoundExceptionHandler
{
	public function __invoke(Request $request, Response $response): Response
	{
		return $response->withJson(['message' => 'Not found'], 404);
	}
}