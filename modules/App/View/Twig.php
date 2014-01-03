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
	 * An instance of Theme
	 *
	 * @var \App\Theme
	 */
	private $theme = null;

	/**
	 * Constructor
	 *
	 * @param \App\Controller\Payload $payload
	 * @param \App\Theme $theme
	 */
	public function __construct(\App\Controller\Payload $payload, \App\Theme $theme) {
		$this->setPayload($payload);
		$this->setTheme($theme);

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
			$dir = dirname(__FILE__) . "/../../{$this->getPayload()->getTemplateDir()}";
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

		/* Register loaders so it looks for sitewide html templates first
		 * and then into specific module templates
		 */
		$loader = new \Twig_Loader_Filesystem(array($this->getTheme()->getDir(), $dir));

		/* Debug environment
		 */
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

	/**
	 * Set theme
	 *
	 * @param \App\Theme $theme
	 */
	private function setTheme($theme) {
		$this->theme = $theme;
	}

	/**
	 * Get theme
	 *
	 * @return \App\Theme
	 */
	private function getTheme() {
		return $this->theme;
	}
}