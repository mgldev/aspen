<?php

namespace Aspen\Http\Controller;

use Aspen\Application;
use Aspen\Http\Request;

trait ApplicationAwareTrait {

	protected $application;
	protected $request;

	/**
	 * @return Application
	 */
	public function getApplication()
	{
		return $this->application;
	}

	/**
	 * @param Application $application
	 */
	public function setApplication(Application $application)
	{
		$this->application = $application;
		return $this;
	}

	/**
	 * @return Request
	 */
	public function getRequest()
	{
		return $this->request;
	}

	/**
	 * @param Request $request
	 */
	public function setRequest(Request $request)
	{
		$this->request = $request;
		return $this;
	}

}