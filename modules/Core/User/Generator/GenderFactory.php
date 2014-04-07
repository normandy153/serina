<?php
/**
 * GenderFactory.php
 *
 * Date: 6/02/2014
 * Time: 10:43 PM
 */

namespace Core\User\Generator;


class GenderFactory extends Base {

	/**
	 * Options
	 *
	 * @var array
	 */
	protected $options = array('m', 'f');

	/**
	 * Spawn an item
	 *
	 * @return \Core\User\Gender
	 */
	public function spawn() {
		$gender = new \Core\User\Gender();
		$gender->selectGender($this->getOption());

		return $gender;
	}
} 