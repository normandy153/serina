<?php
/**
 * AddressFactory.php
 *
 * Date: 6/02/2014
 * Time: 11:06 PM
 */

namespace Core\User\Generator;


class AddressFactory extends Base {

	/**
	 * Options
	 *
	 * @var array
	 */
	protected $options = array(
		'Bourke',
		'Collins',
		'Elizabeth',
		'Exhibition',
		'Flinders',
		'King',
		'Latrobe',
		'Lonsdale',
		'MacArthur',
		'Queen',
		'Russell',
		'Spencer',
		'Spring',
		'Swanston',
		'William',
	);

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/**
	 * Spawn item
	 *
	 * @return mixed|void
	 */
	public function spawn() {
		$number = rand(0,200);

		$street = $this->getOption();

		$suburbFactory = new SuburbFactory();
		$suburb = $suburbFactory->spawn();

		$stateFactory = new StateFactory();
		$state = $stateFactory->spawn();

		$postcodeFactory = new PostcodeFactory();
		$postcode = $postcodeFactory->spawn();

		$countryFactory = new CountryFactory();
		$country = $countryFactory->spawn();

		$address = new \Core\User\Address();
		$address->setAddress1("{$number} {$street} St.");
		$address->setSuburb($suburb);
		$address->setState($state);
		$address->setPostcode($postcode);
		$address->setCountry($country);
	}
} 