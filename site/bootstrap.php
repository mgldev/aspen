<?php

require_once __DIR__ . '/vendor/autoload.php';

$request = \Jenz\Http\Request::createFromGlobals();
die(var_dump($request));

