<?php
/**
 * CountryFactory.php
 *
 * Date: 6/02/2014
 * Time: 10:50 PM
 */

namespace Core\User\Generator;


class CountryFactory extends Base {

	/**
	 * Options
	 *
	 * @var array
	 */
	protected $options = array(
		array(
			'key' => 'AU',
			'value' => 'Australia',
		),
		array(
			'key' => 'US',
			'value' => 'United States',
		),
		array(
			'key' => 'ZA',
			'value' => 'South Africa',
		),
	);

	/**
	 * Spawn an item
	 *
	 * @return \Core\User\Country
	 */
	public function spawn() {
		$item = $this->getOption();

		$country = new \Core\User\Country();
		$country->setAbbreviation($item['key']);
		$country->setName($item['value']);

		return $country;
	}
} 