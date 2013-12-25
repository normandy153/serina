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
		if ($this->getPayload()->getRequest()->getRequestStatus()->getCode() == 200) {
			$loader = new \Twig_Loader_Filesystem(dirname(__FILE__) . '/../../' . $this->getPayload()->getTemplateDir());

			$twig = new \Twig_Environment($loader, array(
				'debug' => true,
			));

			$twig->addExtension(new \Twig_Extension_Debug());

			echo $twig->render($this->getPayload()->getTemplateFile() . '.html', $this->getPayload()->getVars());
		}
		else {

			$loader = new \Twig_Loader_Filesystem(dirname(__FILE__) . '/../../Core');

			$twig = new \Twig_Environment($loader, array(
				'debug' => true,
			));

			$twig->addExtension(new \Twig_Extension_Debug());
new \App\Probe($this->getPayload());
			echo $twig->render($this->getPayload()->getRequest()->getRequestStatus()->getCode() . '.html', $this->getPayload()->getVars());
		}

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
}