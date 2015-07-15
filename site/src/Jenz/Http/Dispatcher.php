<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 15/07/15
 * Time: 16:00
 */

namespace Jenz\Http;


use Jenz\Application;
use Jenz\Http\Controller\ApplicationAwareInterface;
use Jenz\Http\Dispatcher\Value\Handler;

class Dispatcher {

	/**
	 * @var Application
	 */
	protected $application;

	/**
	 * @var	Handler[]
	 */
	protected $handlers;

	/**
	 * @return Handler[]
	 */
	public function getValueHandlers()
	{
		return $this->handlers;
	}

	/**
	 * @param Handler[] $handlers
	 */
	public function setValueHandlers($handlers)
	{
		$this->handlers = $handlers;
		return $this;
	}

	/**
	 * @param Handler $handler
	 * @return $this
	 */
	public function addValueHandler(Handler $handler) {

		$this->handlers[] = $handler;
		return $this;
	}

	public function __construct(Application $application) {

		$this->application = $application;
	}

	public function dispatch(Request $request, Route $route) {

		$container = $this->application->getContainer();

		$controller = $route->getController();

		if ($controller instanceof \Closure) {
			$value = call_user_func($controller);
		} else {

			$action = $route->getAction();
			$controllerInstance = $container->get($controller);

			if ($controller instanceof ApplicationAwareInterface) {
				$controller->setApplication($this->application);
				$controller->setRequest($request);
			}

			$value = $controllerInstance->{$action}();
		}

		$response = $this->handleValue($request, $value);
		return $response;
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param $value
	 * @return Response
	 */
	protected function handleValue(Request $request,  $value) {

		if ($value instanceof Response) {
			return $value;
		}

		foreach ($this->getValueHandlers() as $handler) {
			$response = $handler->handle($request, $value);
			if ($response instanceof Response) {
				return $response;
			}
		}

		if ((!is_object($value) || (is_object($value) && method_exists($value, '__toString'))) && !is_array($value)) {
			return new Response((string) $value);
		}

		throw new \RuntimeException(
			'Unable to handle return value'
		);
	}

}
