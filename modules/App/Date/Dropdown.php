<?php
/**
 * Dropdown.php
 *
 * Date: 21/05/2014
 * Time: 11:33 PM
 */

namespace App\Date;


class Dropdown {

	/**
	 * Restrict maximum years to current year minus this value
	 *
	 * @var int
	 */
	private $minYearOffset = 18;

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	/**
	 * Generate dropdown values
	 *
	 * @return array
	 */
	public function generate() {
		for ($days = array(), $i = 1; $i < 32; $i++) {
			$days[] = array(
				'label' => $i,
				'value' => $i,
				'selected' => false,
			);
		}

		for ($months = array(), $i = 1; $i < 13; $i++) {
			$months[] = array(
				'label' => date('M', mktime(0, 0, 0, $i)),
				'value' => $i,
				'selected' => false,
			);
		}

		/* Minimum age is 18
		 */
		$minYear = date('Y')-$this->getMinYearOffset();

		for ($years = array(), $i = 1900; $i <= $minYear; $i++) {
			if ($i == $minYear) {
				$selected = true;
			}
			else {
				$selected = false;
			}

			$years[] = array(
				'label' => $i,
				'value' => $i,
				'selected' => $selected,
			);
		}

		return array(
			'allDays' => $days,
			'allMonths' => $months,
			'allYears' => $years,
		);
	}

	/* Getters/Setters
	 */

	/**
	 * Set min year offset
	 *
	 * @param int $minYearOffset
	 */
	public function setMinYearOffset($minYearOffset) {
		$this->minYearOffset = $minYearOffset;
	}

	/**
	 * Get min year offset
	 *
	 * @return int
	 */
	public function getMinYearOffset() {
		return $this->minYearOffset;
	}
} 