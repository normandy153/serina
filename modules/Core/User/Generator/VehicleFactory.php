<?php
/**
 * VehicleFactory.php
 *
 * Date: 3/05/2014
 * Time: 02:32 AM
 */

namespace Core\User\Generator;


class VehicleFactory extends Base {

	/**
	 * Spawn an item
	 *
	 * @return mixed|void
	 */
	public function spawn() {
		$colours = array('White', 'Red', 'Green', 'Blue', 'Silver');
		$types = array('4WD', 'Sedan', 'Bicycle');

		$colour = $colours[rand(0, count($colours)-1)];
		$type = $types[rand(0, count($types)-1)];

		$registration = array();

		for($i = 0; $i < 3; $i++) {
			$registration[] = chr(rand(65, 90));
		}

		$registration[] = '-';

		for($i = 0; $i < 3; $i++) {
			$registration[] = rand(0, 9);
		}

		$vehicle = new \Core\User\Vehicle();
		$vehicle->setDescription("{$colour} {$type}");
		$vehicle->setRegistration(implode('', $registration));
		$vehicle->setCapacity(5);

		return $vehicle;
	}
} 