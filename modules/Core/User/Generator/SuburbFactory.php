<?php
/**
 * SuburbFactory.php
 *
 * Date: 6/02/2014
 * Time: 11:09 PM
 */

namespace Core\User\Generator;


class SuburbFactory extends Base {

	/**
	 * Options
	 *
	 * @var array
	 */
	protected $options = array(
		'Burnley',
		'Hawthorn',
		'Glenferrie',
		'Auburn',
		'Camberwell',
		'Chatham',
		'Surrey Hills',
		'Mont Albert',
		'Box Hill',
		'Laburnum',
		'Blackburn',
		'Nunawading',
		'Mitcham',
		'Heatherdale',
		'Ringwood'
	);

	/**
	 * Spawn item
	 *
	 * @return mixed
	 */
	public function spawn() {
		$item = $this->getOption();

		return $item;
	}
} 