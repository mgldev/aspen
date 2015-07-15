<?php

namespace Jenz\Http\Dispatcher\Value\Handler;

use Jenz\Http\Dispatcher\Value\Handler as ValueHandler;
use Jenz\Http\Request;
use Jenz\Http\Response;

class Json implements ValueHandler {

	public function handle(Request $request, $value)
	{
		$response = new Response();
		$response->setHttpHeader('Content-Type', 'application/json');

		if (is_array($value)) {
			$response->setContent(json_encode($value));
		}

		return $response;
	}
}