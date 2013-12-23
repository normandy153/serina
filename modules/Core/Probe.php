<?php
/**
 * Probe
 *
 * Date: 23/12/13
 * Time: 10:42 PM
 */


namespace Core;


class Probe {

	/**
	 * Constructor
	 *
	 * Take a variable and dump it to screen
	 *
	 * @param $var
	 */
	public function __construct($var) {
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}
}