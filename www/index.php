<?php
/**
 * Date: 23/12/13
 * Time: 9:38 PM
 */
require_once('../modules/App/Autoloader.php');
\App\Autoloader::init();

/* Manufacture dependencies
 */
$request = new \App\Request($_REQUEST);
$theme = new \App\Theme();

/* Launch it!
 */
$mediator = new \App\Mediator($request, $theme);