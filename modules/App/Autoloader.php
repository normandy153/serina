<?php
/**
 * Autoloader
 *
 * Date: 23/12/13
 * Time: 9:33 PM
 */

namespace App;

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
		spl_autoload_register(array($this, 'app'));
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
	 * @throws \Exception
	 */
	private function app($classname) {
		$prefix = dirname(__FILE__) . '/../';
		$basename = str_replace('\\', '/', $classname);
		$filename = $basename . '.php';

		$directPath =  $prefix . $filename;
		$customPath = $prefix . 'Custom/' . $filename;
		$corePath = $prefix . 'Core/' . $filename;

		/* Try three possible locations in order
		 */
		if (file_exists($directPath)) {
			require_once($directPath);
		}
		else if (file_exists($customPath)) {
			require_once($customPath);
		}
		else if (file_exists($corePath)) {
			require_once($corePath);
		}
	}
}