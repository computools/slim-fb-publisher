<?php

namespace App\Exception;

use Slim\Http\Request;
use Slim\Http\Response;

class PhpErrorHandler
{
	public function __invoke(Request $request, Response $response, \Error $error): Response
	{
		return $response->withJson([
			'message' => $error->getMessage(),
			'file' => $error->getFile(),
			'line' => $error->getLine()
		], 500);
	}
}