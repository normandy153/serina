<?php
/**
 * Date: 23/12/13
 * Time: 9:38 PM
 */
require_once('../modules/App/Autoloader.php');
\App\Autoloader::init();

$request = new \App\Request($_REQUEST);

$mediator = new \App\Mediator($request);