<?php

require_once __DIR__ . '/../../site/vendor/autoload.php';

class ServiceContainerTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var	Jenz\ServiceContainer
	 */
	protected $object;

	public function setup() {

		$this->object = new Jenz\ServiceContainer();
	}

	/**
	 * @expectedException	\Exception
	 */
	public function testExceptionThrownWhenItemNotSet() {

		$this->object->get('foo');
	}

	public function testSimpleContainerValue() {

		$this->object['foo'] = 'bar';
		$item = $this->object->get('foo');
		$this->assertEquals($item, 'bar');
	}

	public function testCallableContainerValue() {

		$this->object['foo'] = function() {
			return new stdClass;
		};

		$item = $this->object->get('foo');
		$this->assertInstanceOf('stdClass', $item);
	}

	public function testCallableContainerValueIsCached() {

		$this->object['foo'] = function() {
			return new stdClass;
		};

		$hash1 = spl_object_hash($this->object->get('foo'));
		$hash2 = spl_object_hash($this->object->get('foo'));
		$this->assertEquals($hash1, $hash2);
	}

	public function tearDown() {

		unset($this->object);
	}
}
