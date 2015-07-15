<?php

namespace Jenz\Http\Dispatcher\Value\Handler;


use Jenz\Http\Dispatcher\Value\Handler;
use Jenz\Http\Dispatcher\Value\TwigValue;
use Jenz\Http\Request;
use Jenz\Http\Response;

class Twig implements Handler {

	/**
	 * @var	\Twig_Environment
	 */
	protected $twig;

	public function __construct($templatePath, $cachePath) {

		$loader = new \Twig_Loader_Filesystem($templatePath);
		$twig = new \Twig_Environment($loader, array(
			'cache' => $cachePath
		));

		$this->twig = $twig;
	}

	public function handle(Request $request, $value)
	{
		if (!$value instanceof TwigValue) {
			return false;
		}

		$response = new Response();

		$content = $this->twig->render(
			$value->getTemplateName(),
			$value->getAssigns()
		);

		$response->setContent($content);
		return $response;
	}
}