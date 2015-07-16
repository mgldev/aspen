<?php

namespace Aspen\Http\Route;

use Aspen\Http\Request;
use Aspen\Http\Route;

class RESTRoute extends Route {

	protected $url;
	protected $method;

	public function match(Request $request) {

		return $request->getUri() == $this->url && $request->getMethod() == $this->method;
	}

	/**
	 * @return mixed
	 */
	public function getUrl() {

		return $this->url;
	}

	/**
	 * @param mixed $url
	 */
	public function setUrl( $url ) {

		$this->url = $url;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * @param mixed $method
	 */
	public function setMethod($method)
	{
		$this->method = $method;
		return $this;
	}
}
