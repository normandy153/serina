<?php
/**
 * AvatarFactory.php
 *
 * Date: 18/02/2014
 * Time: 11:21 PM
 */

namespace Core\User\Generator;


class AvatarFactory {

	/**
	 * Test avatars
	 *
	 * @var array
	 */
	private $avatars = array(
		'01', '02', '03', '04', '05'
	);

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/**
	 * Spawn avatar
	 *
	 * @return \Core\User\Avatar
	 */
	public function spawn() {
		$avatar = new \Core\User\Avatar();
		$avatar->setFilepath($this->avatars[rand(0, count($this->getAvatars())-1)] . '.jpg');

		return $avatar;
	}

	/* Getters/Setters
	 */

	/**
	 * Set avatars
	 *
	 * @param array $avatars
	 */
	public function setAvatars($avatars) {
		$this->avatars = $avatars;
	}

	/**
	 * Get avatars
	 *
	 * @return array
	 */
	public function getAvatars() {
		return $this->avatars;
	}
} 