<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 15/07/15
 * Time: 21:30
 */

namespace Aspen\Http\Dispatcher\Value;

class JsonApi {

	protected $value;
	protected $errorMessages;
	protected $errorFields;
	protected $httpCode;

	public function __construct($value, array $errorMessages = array(),
								array $errorFields = array(), $httpCode = 200) {

		$this->setValue($value)
				->setErrorMessages($errorMessages)
				->setErrorFields($errorFields)
				->setHttpCode($httpCode);
	}

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @param mixed $value
	 */
	public function setValue($value)
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getErrorMessages()
	{
		return $this->errorMessages;
	}

	/**
	 * @param mixed $errorMessages
	 */
	public function setErrorMessages($errorMessages)
	{
		$this->errorMessages = $errorMessages;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getErrorFields()
	{
		return $this->errorFields;
	}

	/**
	 * @param mixed $errorFields
	 */
	public function setErrorFields($errorFields)
	{
		$this->errorFields = $errorFields;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getHttpCode()
	{
		return $this->httpCode;
	}

	/**
	 * @param mixed $httpCode
	 */
	public function setHttpCode($httpCode)
	{
		$this->httpCode = $httpCode;
		return $this;
	}

	public function toArray() {

		$data = array(
			'httpCode' => $this->getHttpCode(),
			'data' => $this->getValue(),
			'errors' => array(
				'messages' => $this->getErrorMessages(),
				'fields' => $this->getErrorFields()
			)
		);

		return $data;
	}
}
