<?php

use Jenz\Http\Response;
use Jenz\Http\Route\SimpleRoute;
use Jenz\Http\Router;
use Jenz\ServiceContainer;
use Jenz\Http\Request;
use Jenz\Application;

require_once __DIR__ . '/vendor/autoload.php';

$request = Request::createFromGlobals();

$container = new ServiceContainer();
$container['Response'] = function() {
	return new Response();
};
$container['Router'] = function() {
	$router = new Router();
	$newGameRoute = new SimpleRoute();
	$newGameRoute->setUrl('/game/new');
	$newGameRoute->setController('Millionaire\Controller\Game');
	$newGameRoute->setAction('newGameAction');
	$router->addRoute($newGameRoute);

	$endGameRoute = new SimpleRoute();
	$endGameRoute->setUrl('/game/end');
	$endGameRoute->setController('Millionaire\Controller\Game');
	$endGameRoute->setAction('endGameAction');
	$router->addRoute($endGameRoute);

	return $router;
};

$application = new Application($container);

$response = $application->getResponse($request);
