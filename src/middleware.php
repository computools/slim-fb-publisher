<?php

use Slim\Http\Response;

// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
$app->add(new Tuupola\Middleware\JwtAuthentication([
	'secret' => $app->getContainer()['settings']['jwt']['secret'],
	'path' => ['/api'],
	'ignore' => ['/api/auth'],
	'secure' => false,
	'error' => function (Response $response) {
		return $response->withJson(['message' => 'Invalid or expired token'], 401);
	}
]));