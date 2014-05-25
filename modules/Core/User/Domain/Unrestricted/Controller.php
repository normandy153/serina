<?php
/**
 * User
 *
 * Date: 28/01/2014
 * Time: 11:07 PM
 */

namespace Core\User\Domain\Unrestricted;


use App\Controller\Domain\Unrestricted;
use App\Date\Dropdown;
use App\Date\Recombinator;
use App\Probe;
use Core\User\Account;
use Core\User\AccountMapper;
use Core\User\Address;
use Core\User\AddressMapper;
use Core\User\Contact;
use Core\User\ContactMapper;
use Core\User\CountryMapper;
use Core\User\Email;
use Core\User\EmailMapper;
use Core\User\GenderMapper;
use Core\User\Phone;
use Core\User\PhoneMapper;
use Core\User\PhoneTypeMapper;
use Core\User\StateMapper;
use Core\User\User;
use Core\User\UserMapper;
use Core\User\Vehicle;
use Core\User\VehicleMapper;

class Controller extends Unrestricted {

	/**
	 * Prepare a form to create a new user
	 * This also serves as a membership form
	 */
	public function getUserCreate() {
		$dobValues = new Dropdown();

		/* Generate a list of Genders
		 */
		$genderMapper = new GenderMapper();
		$allGenders = $genderMapper->findDropdownValues();

		/* Generate a list of States
		 */
		$stateMapper = new StateMapper();
		$allStates = $stateMapper->findDropdownValues();

		/* Generate a list of Countries
		 */
		$countryMapper = new CountryMapper();
		$allCountries = $countryMapper->findDropdownValues();

		/* Generate a list of Phone Types
		 */
		$phoneTypeMapper = new PhoneTypeMapper();
		$allPhoneTypes = $phoneTypeMapper->findDropdownValues();

		$this->output('getUserCreate', array(
			'dob' => $dobValues->generate(),
			'allGenders' => $allGenders,
			'allStates' => $allStates,
			'allCountries' => $allCountries,
			'allPhoneTypes' => $allPhoneTypes,
		));
	}

	/**
	 * Create a new user
	 */
	public function postUserCreate() {
		$now = date('Y-m-d h:i:s');

		/* Define State
		 */
		$stateMapper = new StateMapper();
		$state = $stateMapper->findById($_POST['address']['state']);

		/* Define Country
		 */
		$countryMapper = new CountryMapper();
		$country = $countryMapper->findById($_POST['address']['country']);

		/* Define Full Address
		 * Address must exist before we can assign them to users
		 */
		$address = new Address();
		$address->setAddress1($_POST['address']['address1']);
		$address->setAddress2($_POST['address']['address2']);
		$address->setSuburb($_POST['address']['suburb']);
		$address->setState($state->getId());
		$address->setPostcode($_POST['address']['postcode']);
		$address->setCountry($country->getId());
		$address->setCreatedAt($now);
		$address->setUpdatedAt($now);
		$address->setDeletedAt(null);

		$addressMapper = new AddressMapper();
		$addressMapper->save($address);

		/* User Details
		 */
		$recombinator = new Recombinator($_POST['dob']);

		/* Define Gender
		 */
		$genderMapper = new GenderMapper();
		$gender = $genderMapper->findById($_POST['gender']);

		/* Define User
		 */
		$user = new User();
		$user->setUuid($user->generateUuid());
		$user->setFirstname($_POST['firstname']);
		$user->setLastname($_POST['lastname']);
		$user->setBirthdate($recombinator->getReverseDatestamp());
		$user->setAddress($address->getId());
		$user->setGender($gender->getId());
		$user->setCreatedAt($now);
		$user->setUpdatedAt($now);
		$user->setDeletedAt(null);

		$mapper = new UserMapper();
		$mapper->save($user);

		/* Define Phone
		 * User needs to exist before we can assign phone numbers to them
		 */
		$phoneMapper = new PhoneMapper();

		for ($i = 0; $i < count($_POST['phone']['number']); $i++) {
			$phone = new Phone();
			$phone->setUserId($user->getId());
			$phone->setNumber($_POST['phone']['number'][$i]);
			$phone->setTypeId($_POST['phone']['type'][$i]);
			$phone->setCreatedAt($now);
			$phone->setUpdatedAt($now);
			$phone->setDeletedAt(null);
			$phoneMapper->save($phone);
		}

		/* Define Email
		 */
		$email = new Email();
		$email->setUserId($user->getId());
		$email->setAddress($_POST['email']);
		$email->setCreatedAt($now);
		$email->setUpdatedAt($now);
		$email->setDeletedAt(null);

		$emailMapper = new EmailMapper();
		$emailMapper->save($email);

		/* Define Contact
		 */
		$contactMapper = new ContactMapper();

		for ($i = 0; $i < count($_POST['contact']['firstname']); $i++) {
			$contact = new Contact();
			$contact->setUserId($user->getId());
			$contact->setFirstname($_POST['contact']['firstname'][$i]);
			$contact->setLastname($_POST['contact']['lastname'][$i]);
			$contact->setPhone($_POST['contact']['phone'][$i]);
			$contact->setNotes($_POST['contact']['notes'][$i]);
			$contact->setCreatedAt($now);
			$contact->setUpdatedAt($now);
			$contact->setDeletedAt(null);
			$contactMapper->save($contact);
		}

		/* Define Vehicles
		 */
		$vehicleMapper = new VehicleMapper();

		for ($i = 0; $i < count($_POST['vehicle']['registration']); $i++) {
			$vehicle = new Vehicle();
			$vehicle->setUserId($user->getId());
			$vehicle->setRegistration($_POST['vehicle']['registration'][$i]);
			$vehicle->setCapacity($_POST['vehicle']['capacity'][$i]);
			$vehicle->setDescription($_POST['vehicle']['description'][$i]);
			$vehicle->setCreatedAt($now);
			$vehicle->setUpdatedAt($now);
			$vehicle->setDeletedAt(null);
			$vehicleMapper->save($vehicle);
		}

		/* Define account
		 * New accounts are always locked
 		 */
//		$username = $_POST['username'];
		$username = 'testusername';
//		$password = $_POST['password'];
		$password = 'testpassword';
		$activationDate = null;
		$expiryDate = date('Y')+1 . '-01-31 23:59:59';
		$locked = 1;

		$account = new Account();
		$account->setUserId($user->getId());
		$account->setUsername($username);
		$account->setPassword($account->encode($password));
		$account->setActivationDate($activationDate);
		$account->setExpiryDate($expiryDate);
		$account->setLocked($locked);
		$account->setCreatedAt($now);
		$account->setUpdatedAt($now);
		$account->setDeletedAt(null);

		$accountMapper = new AccountMapper();
		$accountMapper->save($account);

		exit();
	}

	public function getUserUpdate() {
		$args = $this->getArgs();

		$userMapper = new UserMapper();
		$user = $userMapper->findDetailedById($args[1]);

		/* Prepare date of birth
		 */
		$fragments = explode('-', $user->getBirthdate());

		$dob = new Dropdown();
		$dob->setPreselectedDay($fragments[2]);
		$dob->setPreselectedMonth($fragments[1]);
		$dob->setPreselectedYear($fragments[0]);

		$this->output('getUserModify', array(
			'user' => $user,
			'dob' => $dob->generate(),
		));
	}

	/**
	 * Delete a user
	 */
	public function getUserDelete() {
		$userMapper = new UserMapper();

		$user = $userMapper->findById(57);
		$userMapper->delete($user);

		exit();
	}

	/**
	 * Stub method
	 */
	public function getUserDetail() {
		$mapper = new UserMapper();

		$allUsers = $mapper->findAll();

		new Probe($allUsers);

		exit();
	}
}