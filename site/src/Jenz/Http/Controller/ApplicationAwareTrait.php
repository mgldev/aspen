<?php

namespace Jenz\Http\Controller;

use Jenz\Application;
use Jenz\Http\Request;

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