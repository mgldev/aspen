<?php

namespace Aspen\Http;

/**
 * Class Request
 *
 * @package Aspen
 */
class Request {

	protected $uri = null;
	protected $method = null;

	public static function createFromGlobals() {

		$request = new self;

		$request->uri = $_SERVER['REQUEST_URI'];
		$request->method = $_SERVER['REQUEST_METHOD'];
		return $request;
	}

	public function getUri() {

		return $this->uri;
	}

	/**
	 * @return null
	 */
	public function getMethod()
	{
		return $this->method;
	}

}
