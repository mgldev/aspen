<?php

namespace Application\Controller;

use Aspen\Http\Controller\ApplicationAwareInterface;
use Aspen\Http\Controller\ApplicationAwareTrait;
use Aspen\Http\Dispatcher\Value\JsonApi as JsonApiValue;
use Aspen\Http\Dispatcher\Value\TwigValue;

class Test implements ApplicationAwareInterface {

	use ApplicationAwareTrait;

	public function jsonApiAction() {

		$data = array(
			'id' => 1,
			'name' => 'Yoda',
			'type' => 'cat'
		);

		$errors = array('There are invalid fields in your submission');

		$messages = array(
			'name' => 'Must not be a star wars character'
		);

		return new JsonApiValue(
			$data,
			$errors,
			$messages,
			400
		);
	}

	public function jsonAction() {

		return array(
			'id' => 2,
			'name' => 'Obi One Kanobi',
			'type' => 'Wookie'
		);
	}

	public function twigAction() {

		return new TwigValue(
			'game.twig',
			array(
				'player' => 'Jen Cockerill'
			)
		);
	}
}
