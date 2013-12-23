<?php
/**
 * Date: 23/12/13
 * Time: 9:38 PM
 */
require_once('../modules/Core/Autoloader.php');
\Core\Autoloader::init();

$request = new \Core\Request($_REQUEST);

$request = new \Core\Request(array(
	'route' => 'event/21/gear/1/2/3/4/5'
));

$mediator = new \Core\Mediator($request);