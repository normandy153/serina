<?php
/**
 * User
 *
 * Date: 28/01/2014
 * Time: 11:07 PM
 */

namespace Core\User\Domain\Unrestricted;


use App\Controller\Domain\Unrestricted;
use App\Probe;
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
use Core\User\StateMapper;
use Core\User\User;
use Core\User\UserMapper;

class Controller extends Unrestricted {

	/**
	 * Create/update a user
	 */
	public function getUserSave() {

		/* These typically come from $_POST
		 */
		$firstname = 'Dappy';
		$lastname = 'Bean Baggy';
		$birthdate = date('Y-m-d');
		$genderId = 1;

		$address1 = 'Unit 1';
		$address2 = '10 Test St';
		$suburb = 'Test Suburbia';
		$stateId = 3;
		$postcode = '1234';
		$countryId = 1;

		$landline = '01 9876 5432';
		$mobile = '0456 789 123';

		$emailAddress = 'testuser@test.com.mort.org';

		$contact1Firstname = 'EC Firstname';
		$contact1Lastname = 'EC Lastname';
		$contact1Phone = 'EC Phone 9999 5555';
		$contact1Notes = 'This is my main contact in case I get mangled';

		$contact2Firstname = 'Another EC Firstname';
		$contact2Lastname = 'Another EC Lastname';
		$contact2Phone = 'Another EC Phone 2222 3333';
		$contact2Notes = 'Another contact in case you cannot find the first one';

		$now = date('Y-m-d h:i:s');

		/* Define State
		 */
		$stateMapper = new StateMapper();
		$state = $stateMapper->findById($stateId);

		/* Define Country
		 */
		$countryMapper = new CountryMapper();
		$country = $countryMapper->findById($countryId);

		/* Define Full Address
		 * Address must exist before we can assign them to users
		 */
		$address = new Address();
		$address->setAddress1($address1);
		$address->setAddress2($address2);
		$address->setSuburb($suburb);
		$address->setState($state->getId());
		$address->setPostcode($postcode);
		$address->setCountry($country->getId());
		$address->setCreatedAt($now);
		$address->setUpdatedAt($now);
		$address->setDeletedAt(null);

		$addressMapper = new AddressMapper();
		$addressMapper->save($address);

		/* Define Gender
		 */
		$genderMapper = new GenderMapper();
		$gender = $genderMapper->findById($genderId);

		/* Define User
		 */
		$user = new User();
		$user->setUuid(crypt(uniqid() . sha1(microtime())));
		$user->setFirstname($firstname);
		$user->setLastname($lastname);
		$user->setBirthdate($birthdate);
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

		$phone = new Phone();
		$phone->setUserId($user->getId());
		$phone->setNumber($landline);
		$phone->setTypeId(1);
		$phone->setCreatedAt($now);
		$phone->setUpdatedAt($now);
		$phone->setDeletedAt(null);
		$phoneMapper->save($phone);

		$phone = new Phone();
		$phone->setUserId($user->getId());
		$phone->setNumber($mobile);
		$phone->setTypeId(2);
		$phone->setCreatedAt($now);
		$phone->setUpdatedAt($now);
		$phone->setDeletedAt(null);
		$phoneMapper->save($phone);

		/* Define Email
		 */
		$email = new Email();
		$email->setUserId($user->getId());
		$email->setAddress($emailAddress);
		$email->setCreatedAt($now);
		$email->setUpdatedAt($now);
		$email->setDeletedAt(null);

		$emailMapper = new EmailMapper();
		$emailMapper->save($email);

		/* Define Contact
		 */
		$contactMapper = new ContactMapper();

		$contact = new Contact();
		$contact->setUserId($user->getId());
		$contact->setFirstname($contact1Firstname);
		$contact->setLastname($contact1Lastname);
		$contact->setPhone($contact1Phone);
		$contact->setNotes($contact1Notes);
		$contact->setCreatedAt($now);
		$contact->setUpdatedAt($now);
		$contact->setDeletedAt(null);
		$contactMapper->save($contact);

		$contact = new Contact();
		$contact->setUserId($user->getId());
		$contact->setFirstname($contact2Firstname);
		$contact->setLastname($contact2Lastname);
		$contact->setPhone($contact2Phone);
		$contact->setNotes($contact2Notes);
		$contact->setCreatedAt($now);
		$contact->setUpdatedAt($now);
		$contact->setDeletedAt(null);
		$contactMapper->save($contact);

		exit();
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

		/* Define account
		 */
//		$account = new \Core\User\Account();
//		$account->setUsername('smithj');
//		$account->setPassword($account->encode('smithjpassword'));
//		$account->setActivationDate('2014-02-03 22:10:01');
//		$account->setExpiryDate('2015-02-03 22:10:01');


	}
}