<?php
/**
 * Mediator
 *
 * Date: 23/12/13
 * Time: 10:12 PM
 */


namespace Core;


class Mediator {

	public function __construct($request) {
		new \Core\Probe($request->getArgs());
		new \Core\Probe($request->getEndpoint());
	}
}