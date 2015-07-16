<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 15/07/15
 * Time: 23:07
 */

namespace Aspen\Application\Extension;

use Aspen\Application;
use Aspen\Application\Extension;
use Aspen\Http\Route\RESTRoute;
use Aspen\Http\Router;

class REST extends Extension {

	/**
	 * @return Router
	 */
	protected function getRouter() {

		$router = $this->getApplication()->getContainer()->get('Router');
		return $router;
	}

	public function get($url, \Closure $controller) {

		$route = $this->buildRoute($url, 'GET', $controller);
		$this->getRouter()->addRoute($route);
	}

	public function post($url, \Closure $controller) {

		$route = $this->buildRoute($url, 'POST', $controller);
		$this->getRouter()->addRoute($route);
	}

	public function put($url, \Closure $controller) {

		$route = $this->buildRoute($url, 'PUT', $controller);
		$this->getRouter()->addRoute($route);
	}

	public function delete($url, \Closure $controller) {

		$route = $this->buildRoute($url, 'DELETE', $controller);
		$this->getRouter()->addRoute($route);
	}

	/**
	 * @param $url
	 * @param $method
	 * @param callable $controller
	 * @return RESTRoute
	 */
	protected function buildRoute($url, $method, \Closure $controller) {

		$route = new RESTRoute();
		$route->setUrl($url)->setMethod($method);
		$route->setController($controller);
		return $route;
	}
}