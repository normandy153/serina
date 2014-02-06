<?php
/**
 * PhoneFactory.php
 *
 * Date: 6/02/2014
 * Time: 10:36 PM
 */

namespace Core\User\Generator;


class PhoneFactory extends Base {

	/**
	 * Spawn an item
	 *
	 * @return mixed|void
	 */
	public function spawn() {

	}

	/**
	 * Spawn a landline
	 *
	 * @return \Core\User\Phone
	 */
	public function spawnLandline() {
		$digits = rand(1000, 9999) . ' ' . rand(1000, 9999);

		$phone = new \Core\User\Phone();
		$phone->setNumber($digits);

		return $phone;
	}

	/**
	 * Spawn a mobile
	 */
	public function spawnMobile() {
		$digits = '0' . rand(100, 999) . ' ' . rand(100, 999) . ' ' . rand(100, 999);

		$phone = new \Core\User\Phone();
		$phone->setNumber($digits);

		return $phone;
	}
} 