<?php

namespace Jenz\Http\Dispatcher\Value\Handler;

use Jenz\Http\Dispatcher\Value\Handler as ValueHandler;
use Jenz\Http\Dispatcher\Value\JsonApi as JsonApiValue;
use Jenz\Http\Request;
use Jenz\Http\Response;

class JsonApi implements ValueHandler {

	public function handle(Request $request, $value)
	{

		if (!$value instanceof JsonApiValue) {
			return false;
		}

		$data = $value->toArray();
		$json = json_encode($data);

		$response = new Response();
		$response->setHttpHeader('Content-Type', 'application/json');
		$response->setHttpStatusCode($value->getHttpCode())->setContent($json);
		return true;
	}
}