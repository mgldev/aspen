<?php

namespace Jenz\Http;

class Response {

	protected $content;

	public function getContent() {

		return $this->content;
	}

	public function __toString() {

		return $this->getContent();
	}
}
