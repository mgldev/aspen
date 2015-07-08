<?php

namespace Jenz\Http;

use Jenz\Http\Request;

abstract class Route {

	protected $controller;

	/**
	 * @return mixed
	 */
	public function getController() {

		return $this->controller;
	}

	/**
	 * @param mixed $controller
	 */
	public function setController( $controller ) {

		$this->controller = $controller;
	}

	/**
	 * @return mixed
	 */
	public function getAction() {

		return $this->action;
	}

	/**
	 * @param mixed $action
	 */
	public function setAction( $action ) {

		$this->action = $action;
	}
	protected $action;

	public abstract function match(Request $request);
}
