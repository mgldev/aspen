<?php

namespace Jenz;

use Jenz\Http\Request;
use Jenz\Http\Response;
use Jenz\Http\Router;

class Application {

	/**
	 * @var ServiceContainer
	 */
	protected $container;

	public function __construct(ServiceContainer $container) {
		$this->setContainer($container);
	}

	/**
	 * @return ServiceContainer
	 */
	public function getContainer() {

		return $this->container;
	}

	/**
	 * @param ServiceContainer $container
	 * @return $this
	 */
	public function setContainer(ServiceContainer $container ) {

		$this->container = $container;
		return $this;
	}

	/**
	 * @param Request $request  Incoming request
	 * @return Response         Produced response
	 */
	public function getResponse(Request $request) {

		$response = $this->getContainer()->get('Response');

		$router = $this->getRouter();

		$route = $router->match($request);
		var_dump($route);
		return $response;
	}

	/**
	 * @return Router
	 */
	protected function getRouter() {

		return $this->getContainer()->get('Router');
	}
}
