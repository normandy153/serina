<?php
/**
 * Autoloader
 *
 * Date: 23/12/13
 * Time: 9:33 PM
 */

namespace Core;

class Autoloader {

	/**
	 * Singleton
	 *
	 * @var
	 */
	public static $loader;

	/**
	 * Constructor
	 */
	public function __construct() {
		spl_autoload_register(null, false);
		spl_autoload_extensions('.php');
		spl_autoload_register(array($this, 'core'));
	}

	/**
	 * Init
	 *
	 * @return Autoloader
	 */
	public static function init() {
		if (self::$loader == NULL) {
			self::$loader = new self();
		}

		return self::$loader;
	}

	/**
	 * Autoload core classes
	 *
	 * @param $classname
	 */
	private function core($classname) {
		$path = dirname(__FILE__) . '/../' . str_replace('\\', '/', $classname) . '.php';

		if (file_exists($path)) {
			require_once($path);
		}
		else {
			echo "nope";
		}
//		print_r($path);
	}
}