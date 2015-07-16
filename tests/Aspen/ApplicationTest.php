<?php

require_once __DIR__ . '/../../site/vendor/autoload.php';

use Aspen\Application;
use Aspen\Http\Response;
use Aspen\ServiceContainer;
use Aspen\Http\Request;

class ApplicationTest extends \PHPUnit_Framework_TestCase {

	protected $object;

	public function setup() {

		$container = new ServiceContainer();
		$container['Response'] = function() {
			return new Response();
		};
		$this->object = new Application($container);
	}

	public function testGetResponseReturnsResponse() {

		$request = new Request();
		$response = $this->object->getResponse($request);
		$this->assertInstanceOf('Jenz\Http\Response', $response);
	}

	public function tearDown() {

		unset( $this->object );
	}
}
