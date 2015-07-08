<?php

namespace Jenz\Http;

class Router {

	/**
	 * @var Route[]
	 */
	protected $routes = [];

	/**
	 * @param Route $route
	 *
	 * @return $this
	 */
	public function addRoute(Route $route) {

		$this->routes[] = $route;
		return $this;
	}

	/**
	 * @return Route[]
	 */
	public function getRoutes() {

		return $this->routes;
	}

	/**
	 * Find a route which matches the current Request
	 * @param Request $request
	 */
	public function match(Request $request) {

		foreach ($this->getRoutes() as $route) {
			if ($route->match($request)) {
				return $route;
			}
		}

		return false;
	}
}
