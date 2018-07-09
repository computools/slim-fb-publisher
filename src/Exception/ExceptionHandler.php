<?php

namespace App\Exception;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ExceptionHandler
{
	public function __invoke(Request $request, Response $response, \Exception $exception = null): Response
	{
		if ($exception instanceof ApiException) {
			return $response->withJson(['message' => $exception ? $exception->getMessage() : null], $exception->getCode());
		}
		return $response->withJson(['message' => $exception ? $exception->getMessage() : null], 500);
	}
}