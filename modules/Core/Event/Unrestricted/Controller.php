<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sarif
 * Date: 14/01/2014
 * Time: 11:46 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Core\Event\Unrestricted;


class Controller extends \App\Controller\Type\Unrestricted {

	/**
	 * Detail view of a particular event
	 */
	public function getEventDetail() {

		$this->output('getEventDetail', array(
			'collection' => array(
				'mort'
			)
		));
	}
}