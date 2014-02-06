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

		$emailAddress = 'test' . rand(100,999) . '@test.com';

		$lower = $_SERVER['REQUEST_TIME'] - 60*60*24*365*50;
		$upper = $_SERVER['REQUEST_TIME'] - 60*60*24*365*18;

		$birthday = date('Y-m-d', rand($lower, $upper));

		$addressFactory = new AddressFactory();
		$address = $addressFactory->spawn();

		$genderFactory = new GenderFactory();
		$gender = $genderFactory->spawn();

		$phoneFactory = new PhoneFactory();

		$landline = $phoneFactory->spawnLandline();
		$mobile = $phoneFactory->spawnMobile();

		$accountFactory = new AccountFactory($firstname, $lastname);
		$account = $accountFactory->spawn();

		$user = new \Core\User();
		$user->setUuid(crypt(uniqid() . sha1(microtime())));
		$user->setFirstname($firstname);
		$user->setLastname($lastname);
		$user->setBirthdate($birthday);
		$user->setAddress($address);
		$user->setGender($gender);
		$user->setPhone($landline);
		$user->setMobile($mobile);
		$user->setEmail($emailAddress);
		$user->setAccount($account);
		$user->setCreatedAt(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
		$user->setUpdatedAt(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']));
new \App\Probe($user);
		return $user;
	}
} 