<?php

namespace App\Exception;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class MethodNotAllowedExceptionHandler
{
	public function __invoke(Request $request, Response $response, $methods): Response
	{
		return $response->withJson(['message' => 'Method not allowed. Allowed: ' . implode(',', $methods)], 405);
	}
}