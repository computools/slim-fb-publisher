<?php

namespace App\Validation;

use DavidePastore\Slim\Validation\Validation;
use Psr\Http\Message\RequestInterface;
use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Validator;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Route;

abstract class AbstractValidator
{
	abstract protected function rules(): array;

	public function __invoke($request, $response, $next)
	{
		$validation = new Validation($this->rules(), null, ['useTemplate' => true]);
		return $validation($request, $response, function ($request, $response) use ($next) {
			if ($request->getAttribute('has_errors')) {
				return $response->withJson(['errors' => $request->getAttribute('errors')], 400);
			}
			return $next($request, $response);
		});
	}
}