<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 15/07/15
 * Time: 23:06
 */

namespace Jenz\Application;


use Jenz\Application;

abstract class Extension {

	/**
	 * @var	Application
	 */
	protected $application;

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
}