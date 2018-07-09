<?php

use Slim\Http\Request;
use Slim\Http\Response;


// Routes

$app->get('/', function (Request $request, Response $response, array $args) {
	return $this->renderer->render($response, 'index.phtml', $args);
});

$app->group('/api', function() use ($app) {
	$app->get('/', function (Request $request, Response $response) {
		return $response->withJson(['message' => 'API for template project']);
	});

	// user
	$app->post('/auth/register', \App\Action\Auth\RegisterAction::class)->add(\App\Validation\Auth\RegisterRequest::class);
	$app->post('/auth/login', \App\Action\Auth\LoginAction::class)->add(\App\Validation\Auth\RegisterRequest::class);

	// user
	$app->get('/user', \App\Action\User\UserAction::class);

	// post
	$app->get('/post', \App\Action\Post\PostListAction::class);
	$app->get('/post/{postId}', \App\Action\Post\GetPostAction::class);
	$app->post('/post', \App\Action\Post\CreatePostAction::class)->add(\App\Validation\Post\PostRequest::class);
	$app->put('/post/{postId}', \App\Action\Post\UpdatePostAction::class)->add(\App\Validation\Post\PostRequest::class);
	$app->delete('/post/{postId}', \App\Action\Post\RemovePostAction::class);
	$app->put('/post/{postId}/theme/{themeId}', \App\Action\Post\AddPostThemeAction::class);
	$app->delete('/post/{postId}/theme/{themeId}', \App\Action\Post\RemovePostThemeAction::class);

	// theme
	$app->get('/theme', \App\Action\Theme\ListThemesAction::class);
	$app->post('/theme', \App\Action\Theme\CreateThemeAction::class)->add(\App\Validation\Theme\ThemeRequest::class);
	$app->put('/theme/{themeId}', \App\Action\Theme\UpdateThemeAction::class)->add(\App\Validation\Theme\ThemeRequest::class);
	$app->delete('/theme/{themeId}', \App\Action\Theme\RemoveThemeAction::class);

	// channel
	$app->get('/channel/link', \App\Action\Channel\GetAuthLinkAction::class);
	$app->post('/channel', \App\Action\Channel\CreateChannelAction::class);
	$app->get('/channel', \App\Action\Channel\ListChannelsAction::class);

	// publication
	$app->post('/post/{postId}/publication/{channelId}', \App\Action\Publication\CreatePublicationAction::class);
});