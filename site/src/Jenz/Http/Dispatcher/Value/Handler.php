<?php

namespace Jenz\Http\Dispatcher\Value;

use Jenz\Http\Request;
use Jenz\Http\Response;

interface Handler {

	public function handle(Request $request, $value);
}