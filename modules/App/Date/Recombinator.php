<?php
/**
 * Recombinator.php
 *
 * Takes an array of date elements in the day, month, year
 * ordering e.g.
 *
 * $dob['day'] = 1;
 * $dob['month'] = 5;
 * $dob['year'] = 1991;
 *
 * new Recombinator($dob);
 *
 * Date: 25/05/2014
 * Time: 2:16 PM
 */

namespace App\Date;


class Recombinator {

	/**
	 * Fragments of the date to recombine
	 *
	 * @var array
	 */
	private $dateFragments = array();

	/**
	 * Constructor
	 *

	 * @param $dateFragments
	 */
	public function __construct($dateFragments) {
		$this->setDateFragments($dateFragments);
	}

	/**
	 * Get reverse datestamp
	 *
	 * @return string
	 */
	public function getReverseDatestamp() {
		$fragments = array_reverse(array_values($this->getDateFragments()));

		$dob = array();

		foreach($fragments as $currentFragment) {
			$dob[] = sprintf("%02d", $currentFragment);
		}

		return implode('-', $dob);
	}

	/* Getters/Setters
	 */

	/**
	 * Set date fragments
	 *
	 * @param array $dateFragments
	 */
	private function setDateFragments($dateFragments) {
		$this->dateFragments = $dateFragments;
	}

	/**
	 * Get date fragments
	 *
	 * @return array
	 */
	public function getDateFragments() {
		return $this->dateFragments;
	}
}