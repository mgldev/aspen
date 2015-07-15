<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 15/07/15
 * Time: 15:58
 */

namespace Jenz\Http\Controller;


use Jenz\Application;
use Jenz\Http\Request;

interface ApplicationAwareInterface {

	public function setApplication(Application $application);
	public function setRequest(Request $request);
}