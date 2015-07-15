<?php

namespace Jenz;

use Jenz\Http\Request;
use Jenz\Http\Response;
use Jenz\Http\Router;
use Jenz\Http\Dispatcher;

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

		try {

			$router = $this->getRouter();
			$route = $router->match($request);

			if (!$route) {
				throw new \Exception('404! Route not found');
			}

			$dispatcher = $this->getDispatcher();

			$response = $dispatcher->dispatch($request, $route);

		} catch (\Exception $ex) {
			throw $ex;
		}

		return $response;
	}

	/**
	 * @return Router
	 */
	protected function getRouter() {

		return $this->getContainer()->get('Router');
	}

	/**
	 * @return Dispatcher
	 */
	protected function getDispatcher() {

		return $this->getContainer()->get('Dispatcher');
	}
}
