<?php

use Application\Controller\Test as TestController;
use Aspen\Application\Extension\REST as RESTExtension;
use Aspen\Http\Dispatcher;
use Aspen\Http\Dispatcher\Value\Handler\Json as JsonValueHandler;
use Aspen\Http\Dispatcher\Value\Handler\JsonApi as JsonApiValueHandler;
use Aspen\Http\Dispatcher\Value\Handler\Twig as TwigValueHandler;
use Aspen\Http\Dispatcher\Value\TwigValue;
use Aspen\Http\Response;
use Aspen\Http\Route\SimpleRoute;
use Aspen\Http\Router;
use Aspen\ServiceContainer;
use Aspen\Http\Request;
use Aspen\Application;

require_once __DIR__ . '/vendor/autoload.php';

$request = Request::createFromGlobals();

$container = new ServiceContainer();
$application = new Application($container);

$container['Response'] = function() {
	return new Response();
};

$container['Application\Controller\Test'] = function() {
	return new TestController();
};

$container['Router'] = function() {

	$router = new Router();
	
	$route1 = new SimpleRoute();
	$route1->setUrl('/test/jsonapi');
	$route1->setController('Application\Controller\Test');
	$route1->setAction('jsonApiAction');
	$router->addRoute($route1);

	$route2 = new SimpleRoute();
	$route2->setUrl('/test/json');
	$route2->setController('Application\Controller\Test');
	$route2->setAction('jsonAction');
	$router->addRoute($route2);

	$route3 = new SimpleRoute();
	$route3->setUrl('/test/twig');
	$route3->setController('Application\Controller\Test');
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