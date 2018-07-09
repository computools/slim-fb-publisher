<?php
// DIC configuration

$container = $app->getContainer();

$container['phpErrorHandler'] = function ($container) {
	return new \App\Exception\PhpErrorHandler();
};

$container['errorHandler'] = function ($container) {
	return new \App\Exception\ExceptionHandler();
};

$container['notFoundHandler'] = function ($container) {
	return new \App\Exception\NotFoundExceptionHandler();
};

$container['notAllowedHandler'] = function ($container) {
	return new \App\Exception\MethodNotAllowedExceptionHandler();
};

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};


$container['db'] = function ($c) {
	$settings = $c->get('settings');
	$pdo = new \PDO(
		sprintf(
			'%s:host=%s;port=%s;dbname=%s',
			$settings['db']['driver'],
			$settings['db']['host'],
			$settings['db']['port'],
			$settings['db']['name']
		),
		$settings['db']['user'],
		$settings['db']['password']
	);

	return new \LessQL\Database($pdo);
};

$container['repositoryFactory'] = function ($c) {
	return new \Computools\LessqlORM\Repository\EntityRepositoryFactory($c['db']);
};

$container['facebook'] = function ($c) {
	$settings = $c->get('settings');
	return new \App\Service\FacebookService(
		new \Facebook\Facebook($settings['facebook']['config']), $settings['facebook']['redirect_uri']);
};