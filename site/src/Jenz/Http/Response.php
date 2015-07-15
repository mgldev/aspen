<?php

namespace Jenz\Http;

class Response {

	protected $content;

	public function __construct($content = null) {

		$this->setContent($content);
	}

	public function setContent($content) {

		$this->content = $content;
		return $this;
	}

	public function getContent() {

		return (string) $this->content;
	}

	public function __toString() {

		return $this->getContent();
	}

	public function setHttpStatusCode($code) {

		http_response_code($code);
		return $this;
	}

	public function setHttpHeader($key, $value) {

		header($key . ': ' . $value);
		return $this;
	}
}
