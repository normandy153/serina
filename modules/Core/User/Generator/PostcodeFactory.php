<?php
/**
 * PostcodeFactory.php
 *
 * Date: 6/02/2014
 * Time: 11:12 PM
 */

namespace Core\User\Generator;


class PostcodeFactory {

	/**
	 * Spawn an item
	 *
	 * @return int
	 */
	public function spawn() {
		return rand(1000, 9999);
	}
} 