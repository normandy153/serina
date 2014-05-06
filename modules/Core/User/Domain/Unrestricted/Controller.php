<?php
/**
 * User
 *
 * Date: 28/01/2014
 * Time: 11:07 PM
 */

namespace Core\User\Domain\Unrestricted;


class Controller extends \App\Controller\Domain\Unrestricted {

	public function getUserSave() {

		$user = new \Core\User();
		$user->setId(3);
		$user->setFirstname('Flappy');
		$user->setLastname('Chappy');
		$user->setBirthdate('1979-09-09');

		$mapper = new \Core\User\UserMapper();
		$mapper->save($user);
	}

	/**
	 * Stub method
	 */
	public function getUserDetail() {

		/* Define State
		 */
		$state = new \Core\User\State();
		$state->setAbbreviation('VIC');
		$state->setName('Victoria');

		/* Define Country
		 */
		$country = new \Core\User\Country();
		$country->setAbbreviation('AU');
		$country->setName('Australia');

		/* Define Full Address
		 */
		$address = new \Core\User\Address();
		$address->setAddress1('Unit 1');
		$address->setAddress2('10 Test St');
		$address->setSuburb('Test Suburb');
		$address->setState($state);
		$address->setPostcode('1234');
		$address->setCountry($country);

		/* Define Gender
		 */
		$gender = new \Core\User\Gender('M');

		/* Define Phone numbers
		 */
		$phone = new \Core\User\Phone();
		$phone->setNumber('02 1234 5678');

		/* Define Mobile numbers
		 */
		$mobile = new \Core\User\Phone();
		$mobile->setNumber('0111 234 567');

		/* Define Email
		 */
		$email = new \Core\User\Email();
		$email->setAddress('test@test.com');

		/* Define Emergency Contact info
		 */
		$contactPhone = new \Core\User\Phone();
		$contactPhone->setNumber('5555 6666');

		$contactMobile = new \Core\User\Phone();
		$contactMobile->setNumber('7777 8888');

		$contact = new \Core\User();
		$contact->setFirstname('Joe');
		$contact->setLastname('Smith');
		$contact->setPhone($contactPhone);
		$contact->setMobile($contactMobile);

		/* Define account
		 */
		$account = new \Core\User\Account();
		$account->setUsername('smithj');
		$account->setPassword($account->encode('smithjpassword'));
		$account->setActivationDate('2014-02-03 22:10:01');
		$account->setExpiryDate('2015-02-03 22:10:01');

		/* Define test User
		 */
		$user = new \Core\User();
		$user->setUuid(crypt(uniqid() . sha1(microtime())));
		$user->setFirstname('John');
		$user->setLastname('Smith');
		$user->setBirthdate('1990-11-07');
		$user->setGender($gender);
		$user->setAddress($address);
		$user->setPhone($phone);
		$user->setMobile($mobile);
		$user->setEmail($email);
		$user->setEmergencyContact($contact);
		$user->setAccount($account);
		$user->setCreatedAt('2010-06-19 14:45:34');
		$user->setUpdatedAt('2010-06-19 14:45:34');

		new \App\Probe($user);
		exit();

		$this->output('getUserDetail', array(
			$user
		));
	}
}