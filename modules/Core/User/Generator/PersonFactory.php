<?php
/**
 * UserFactory.php
 *
 * Date: 6/02/2014
 * Time: 11:16 PM
 */

namespace Core\User\Generator;


class PersonFactory extends Base {

	/**
	 * Options
	 *
	 * @var array
	 */
	protected $options = array();

	/**
	 * Firstnames
	 *
	 * @var array
	 */
	private $firstnames = array(
		'Alesandro',
		'Enrik',
		'Flavio',
		'Luis',
		'Aleksio',
		'Daan',
		'Bram',
		'Sem',
		'Lucas',
		'Milan',
		'Levi',
		'Luuk',
		'Thijs',
		'Olivia',
		'Emma',
		'Sophia',
		'Emily',
		'Ava',
		'Ella',
		'Chloe',
		'Isabella',
		'Avery',
		'Hannah',
		'Madison',
		'London',
		'Taylor',
	);

	/**
	 * Surnames
	 *
	 * @var array
	 */
	protected $lastnames = array(
		'Wood',
		'Watson',
		'Brooks',
		'Bennett',
		'Gray',
		'James',
		'Reyes',
		'Cruz',
		'Hughes',
		'Price',
		'Myers',
		'Long',
		'Foster',
		'Sanders',
		'Ross',
		'Morales',
		'Powell',
		'Sullivan',
		'Russell',
		'Ortiz',
		'Jenkins',
		'Gutiérrez',
		'Perry',
		'Butler',
		'Barnes',
		'Fisher',
	);

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	/**
	 * Spawn item
	 *
	 * @return \Core\User|mixed
	 */
	public function spawn() {
		$index1 = rand(0, count($this->firstnames)-1);
		$index2 = rand(0, count($this->firstnames)-1);

		$firstname = $this->firstnames[$index1];
		$lastname = $this->lastnames[$index2];

		$emailCollection = new \App\Collection();
		$emailCollection->add('test' . rand(100,999) . '@test.com');
		$emailCollection->add('test' . rand(100,999) . '@test.com');
		$emailCollection->add('test' . rand(100,999) . '@test.com');

		$lower = $_SERVER['REQUEST_TIME'] - 60*60*24*365*50;
		$upper = $_SERVER['REQUEST_TIME'] - 60*60*24*365*18;

		$birthday = date('Y-m-d', rand($lower, $upper));

		$addressFactory = new AddressFactory();
		$addressCollection = new \App\Collection();
		$addressCollection->add($addressFactory->spawn());

		$genderFactory = new GenderFactory();
		$genderCollection = new \App\Collection();
		$genderCollection->add($genderFactory->spawn());

		$phoneFactory = new PhoneFactory();
		$phoneCollection = new \App\Collection();
		$phoneCollection->add($phoneFactory->spawnLandline());
		$phoneCollection->add($phoneFactory->spawnLandline());
		$phoneCollection->add($phoneFactory->spawnMobile());

		$accountFactory = new AccountFactory($firstname, $lastname);
		$accountCollection = new \App\Collection();
		$accountCollection->add($accountFactory->spawn());

		$vehicleFactory = new VehicleFactory();
		$vehicleCollection = new \App\Collection();
		$vehicleCollection->add($vehicleFactory->spawn());

		$user = new \Core\User();
		$user->setUuid(crypt(uniqid() . sha1(microtime())));
		$user->setFirstname($firstname);
		$user->setLastname($lastname);
		$user->setBirthdate($birthday);
		$user->setAddress($addressCollection);
		$user->setGender($genderCollection);
		$user->setPhone($phoneCollection);
		$user->setEmail($emailCollection);
		$user->setAccount($accountCollection);
		$user->setVehicle($vehicleCollection);
		$user->setCreatedAt(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
		$user->setUpdatedAt(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));

		return $user;
	}
} 