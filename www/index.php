<?php
/**
 * Date: 23/12/13
 * Time: 9:38 PM
 */
require_once('../modules/App/Autoloader.php');
\App\Autoloader::init();

date_default_timezone_set('Australia/Melbourne');

/* Manufacture dependencies
 */

/* Set up modified Request, via custom routes
 */
$router = new \App\Router($_REQUEST);
$request = $router->produce();

/* Selected theme
 */
$theme = new \App\Theme();

/* Launch it!
 */
$mediator = new \App\Mediator($request, $theme);
$mediator->run();