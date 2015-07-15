<?php

namespace Jenz;

use Jenz\Application\Extension;
use Jenz\Http\Request;
use Jenz\Http\Response;
use Jenz\Http\Router;
use Jenz\Http\Dispatcher;

class Application {

	protected $extensions = [];

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

	/**
	 * @return Extension[]
	 */
	public function getExtensions()
	{
		return $this->extensions;
	}

	/**
	 * @param array $extensions
	 */
	public function setExtensions($extensions)
	{
		foreach ($extensions as $extension) {
			$this->extend($extension);
		}
		return $this;
	}

	/**
	 * @param Extension $extension
	 * @return $this
	 */
	public function extend(Extension $extension) {

		$extension->setApplication($this);
		$this->extensions[] = $extension;
		return $this;
	}

	/**
	 * @param $name
	 * @param $arguments
	 */
	public function __call($name, $arguments) {

		foreach ($this->getExtensions() as $extension) {
			if (method_exists($extension, $name)) {
				call_user_func_array(array($extension, $name), $arguments);
				return;
			}
		}

		throw new \RuntimeException(
			'No method named "' . $name . '" could be found within the Application ' .
													'class or any of the registered extensions'
		);
	}
}
