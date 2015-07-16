<?php

namespace Aspen;

class ServiceContainer extends \ArrayObject {

	protected $cache = [];

	public function get($name) {

		if (!isset($this[$name])) {
			throw new \Exception('Item "' . $name . '" could not be found in the Service Container"');
		}

		if (is_callable($this[$name])) {

			if (isset($this->cache[$name])) {
				return $this->cache[$name];
			}

			$item = call_user_func($this[$name]);
			$this->cache[$name] = $item;
			return $item;
		}

		return $this[$name];

	}
}
