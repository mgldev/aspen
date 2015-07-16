<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 15/07/15
 * Time: 21:30
 */

namespace Aspen\Http\Dispatcher\Value;

class TwigValue {

	protected $templateName;
	protected $assigns;

	public function __construct($templateName, array $assigns = array()) {

		$this->setTemplateName($templateName)->setAssigns($assigns);
	}

	/**
	 * @return mixed
	 */
	public function getTemplateName()
	{
		return $this->templateName;
	}

	/**
	 * @param mixed $templateName
	 */
	public function setTemplateName($templateName)
	{
		$this->templateName = $templateName;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getAssigns()
	{
		return $this->assigns;
	}

	/**
	 * @param array $assigns
	 */
	public function setAssigns(array $assigns)
	{
		foreach ($assigns as $key => $value) {
			$this->assign($key, $value);
		}

		return $this;
	}

	/**
	 * @param $key
	 * @param $value
	 * @return $this
	 */
	public function assign($key, $value) {

		$this->assigns[$key] = $value;
		return $this;
	}
}
