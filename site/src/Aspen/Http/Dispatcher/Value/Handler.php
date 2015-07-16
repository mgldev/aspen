<?php

namespace Aspen\Http\Dispatcher\Value;

use Aspen\Http\Request;
use Aspen\Http\Response;

interface Handler {

	public function handle(Request $request, $value);
}