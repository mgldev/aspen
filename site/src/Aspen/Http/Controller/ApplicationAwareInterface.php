<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 15/07/15
 * Time: 15:58
 */

namespace Aspen\Http\Controller;


use Aspen\Application;
use Aspen\Http\Request;

interface ApplicationAwareInterface {

	public function setApplication(Application $application);
	public function setRequest(Request $request);
}