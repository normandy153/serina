<?php
/**
 * Date: 23/12/13
 * Time: 9:38 PM
 */
require_once('../modules/Core/Autoloader.php');
\Core\Autoloader::init();

$request = new \Core\Request($_REQUEST);

$mediator = new \Core\Mediator($request);