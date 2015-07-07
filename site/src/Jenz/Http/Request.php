<?php

namespace Jenz\Http;

/**
 * Class Request
 *
 * @package Jenz
 */
class Request {

	protected $uri = null;

	public static function createFromGlobals() {

		$request = new self;

		$request->uri = $_SERVER['REQUEST_URI'];
		return $request;
	}

	public function getUri() {

		return $this->uri;
	}

}
