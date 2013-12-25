<?php
/**
 * Twig
 *
 * Date: 24/12/13
 * Time: 4:45 PM
 */


namespace App\View;


class Twig {

	/**
	 * The data to render
	 *
	 * @var null
	 */
	private $payload = null;

	/**
	 * A list of locations which a Controller might exist
	 *
	 * @var array
	 */
	private $dirs = array(
		'Custom', 'Core'
	);

	/**
	 * Constructor
	 *
	 * @param \App\Controller\Payload $payload
	 */
	public function __construct(\App\Controller\Payload $payload) {
		$this->setPayload($payload);

		$this->setup();
	}

	/**
	 * Hook method
	 */
	protected function setup() {

		/* Normally check that a view method also exists, but instead,
		 * pipe through straight to twig
		 */
		$vendorPath = dirname(__FILE__) . '/../../../vendor';

		require_once("$vendorPath/Twig-1.15.0/lib/Twig/Autoloader.php");
		\Twig_Autoloader::register();
	}

	/**
	 * Render vars in twig
	 */
	public function render() {

		/* Load templates as normal
		 */
		if (!$this->getPayload()->getRequest()->getRequestStatus()->hasError()) {
			$dir = dirname(__FILE__) . '/../../' . $this->getPayload()->getTemplateDir();
			$file = $this->getPayload()->getTemplateFile() . '.html';
		}
		/* Load error templates
		 * See if Custom modules/data overrides core defaults
		 */
		else {
			foreach ($this->getDirs() as $currentDir) {
				$file = 'error.html';

				$prefix = dirname(__FILE__) . "/../../{$currentDir}";
				$path =  "{$prefix}/{$file}";

				if (file_exists($path)) {
					$dir = $prefix;

					break;
				}
			}
		}

		echo $this->startTwig($dir)->render($file, $this->getPayload()->getVars());
	}

	/**
	 * A macro for initialising twig stuff
	 *
	 * @param $dir
	 * @return \Twig_Environment
	 */
	private function startTwig($dir) {
		$loader = new \Twig_Loader_Filesystem($dir);

		$twig = new \Twig_Environment($loader, array(
			'debug' => true,
		));

		$twig->addExtension(new \Twig_Extension_Debug());

		return $twig;
	}

	/* Getters/Setters
 	 */

	/**
	 * Set payload
	 *
	 * @param null $payload
	 */
	private function setPayload($payload) {
		$this->payload = $payload;
	}

	/**
	 * Get payload
	 *
	 * @return null
	 */
	private function getPayload() {
		return $this->payload;
	}

	/**
	 * Set dirs
	 *
	 * @param array $dirs
	 */
	private function setDirs($dirs) {
		$this->dirs = $dirs;
	}

	/**
	 * Get dirs
	 *
	 * @return array
	 */
	private function getDirs() {
		return $this->dirs;
	}
}