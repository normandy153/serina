<?php
/**
 * StateFactory.php
 *
 * Spawn some test items
 *
 * Date: 6/02/2014
 * Time: 10:04 PM
 */

namespace Core\User\Generator;


class StateFactory extends Base {

	/**
	 * Options
	 *
	 * @var array
	 */
	protected $options = array(
		array(
			'key' => 'VIC',
			'value' => 'Victoria'
		),
		array(
			'key' => 'NSW',
			'value' => 'New South Wales'
		),
		array(
			'key' => 'ACT',
			'value' => 'Australian Capital Territory',
		),
		array(
			'key' => 'QLD',
			'value' => 'Queensland',
		),
		array(
			'key' => 'NT',
			'value' => 'Northern Territory',
		),
		array(
			'key' => 'WA',
			'value' => 'Western Australia',
		),
		array(
			'key' => 'SA',
			'value' => 'South Australia',
		),
		array(
			'key' => 'TAS',
			'value' => 'Tasmania',
		),
	);

	/**
	 * Spawn an item
	 *
	 * @return \Core\User\State
	 */
	public function spawn() {
		$item = $this->getOption();

		$state = new \Core\User\State();
		$state->setAbbreviation($item['key']);
		$state->setName($item['value']);

		return $state;
	}
} 