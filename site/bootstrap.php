<?php

use Jenz\Application\Extension\REST as RESTExtension;
use Jenz\Http\Dispatcher;
use Jenz\Http\Dispatcher\Value\Handler\Json as JsonValueHandler;
use Jenz\Http\Dispatcher\Value\Handler\JsonApi as JsonApiValueHandler;
use Jenz\Http\Dispatcher\Value\Handler\Twig as TwigValueHandler;
use Jenz\Http\Dispatcher\Value\TwigValue;
use Jenz\Http\Response;
use Jenz\Http\Route\SimpleRoute;
use Jenz\Http\Router;
use Jenz\ServiceContainer;
use Jenz\Http\Request;
use Jenz\Application;

require_once __DIR__ . '/vendor/autoload.php';

$request = Request::createFromGlobals();

$container = new ServiceContainer();
$application = new Application($container);

$container['Response'] = function() {
	return new Response();
};

$container['Millionaire\Controller\Question'] = function() {
	return new Millionaire\Controller\Question();
};

$container['Router'] = function() {

	$router = new Router();
	
	$route1 = new SimpleRoute();
	$route1->setUrl('/question/jsonapi');
	$route1->setController('Millionaire\Controller\Question');
	$route1->setAction('jsonApiAction');
	$router->addRoute($route1);

	$route2 = new SimpleRoute();
	$route2->setUrl('/question/json');
	$route2->setController('Millionaire\Controller\Question');
	$route2->setAction('jsonAction');
	$router->addRoute($route2);

	$route3 = new SimpleRoute();
	$route3->setUrl('/question/twig');
	$route3->setController('Millionaire\Controller\Question');
	$route3->setAction('twigAction');
	$router->addRoute($route3);

	return $router;
};

$container['Dispatcher'] = function() use ($application) {

	$dispatcher = new Dispatcher($application);

	$dispatcher->addValueHandler(new JsonApiValueHandler());

	$twigHandler = new TwigValueHandler(
		__DIR__ . '/templates',
		__DIR__ . '/cache/twig'
	);

	$dispatcher->addValueHandler($twigHandler);

	$dispatcher->addValueHandler(new JsonValueHandler());

	return $dispatcher;
};

$application->extend(new RESTExtension());

$application->post('/hello', function() {
	return new TwigValue(
		'hello.twig',
		array('name' => 'Mike')
	);
});

$response = $application->getResponse($request);
echo $response;