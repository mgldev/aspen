<?php

namespace Jenz\Http\Route;

use Jenz\Http\Request;
use Jenz\Http\Route;

class SimpleRoute extends Route {

	/**
	 * @var
	 */
	protected $url;

	public function match(Request $request) {

		return $request->getUri() == $this->url;
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
	}
}
