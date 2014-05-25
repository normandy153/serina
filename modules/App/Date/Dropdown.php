<?php
/**
 * Dropdown.php
 *
 * Generate date values suitable for dropdown selections
 *
 * This is a mutable instance, so you can use:
 *
 * $dropdown->setMinYearOffset(0);
 * $dropdown->setPreselectedDay(1);
 *
 * ...to alter the possible options from which you can choose.
 * These are also chainable operations
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
	 * Preselected day
	 *
	 * @var int
	 */
	private $preselectedDay = -1;

	/**
	 * Preselected month
	 *
	 * @var int
	 */
	private $preselectedMonth = -1;

	/**
	 * Preselected year
	 *
	 * @var int
	 */
	private $preselectedYear = -1;

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
			if ($i == $this->getPreselectedDay()) {
				$selected = true;
			}
			else {
				$selected = false;
			}

			$days[] = array(
				'label' => $i,
				'value' => $i,
				'selected' => $selected,
			);
		}

		for ($months = array(), $i = 1; $i < 13; $i++) {
			if ($i == $this->getPreselectedMonth()) {
				$selected = true;
			}
			else {
				$selected = false;
			}

			$months[] = array(
				'label' => date('M', mktime(0, 0, 0, $i)),
				'value' => $i,
				'selected' => $selected,
			);
		}

		/* Minimum age is 18
		 */
		$minYear = date('Y')-$this->getMinYearOffset();

		for ($years = array(), $i = 1900; $i <= $minYear; $i++) {
			$selected = false;

			/* If a preselected value is provided, match that
			 * Otherwise match it based on min year
			 */
			if ($this->getPreselectedYear() > -1) {
				if ($i == $this->getPreselectedYear()) {
					$selected = true;
				}
			}
			else if ($i == $minYear) {
				$selected = true;
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
	 * @return $this
	 */
	public function setMinYearOffset($minYearOffset) {
		$this->minYearOffset = $minYearOffset;

		return $this;
	}

	/**
	 * Get min year offset
	 *
	 * @return int
	 */
	public function getMinYearOffset() {
		return $this->minYearOffset;
	}

	/**
	 * Set preselected day
	 *
	 * @param int $preselectedDay
	 * @return $this
	 */
	public function setPreselectedDay($preselectedDay) {
		$this->preselectedDay = $preselectedDay;

		return $this;
	}

	/**
	 * Get preselected day
	 *
	 * @return int
	 */
	public function getPreselectedDay() {
		return $this->preselectedDay;
	}

	/**
	 * Set preselected month
	 *
	 * @param int $preselectedMonth
	 * @return $this
	 */
	public function setPreselectedMonth($preselectedMonth) {
		$this->preselectedMonth = $preselectedMonth;

		return $this;
	}

	/**
	 * Get preselected month
	 *
	 * @return int
	 */
	public function getPreselectedMonth() {
		return $this->preselectedMonth;
	}

	/**
	 * Set preselected year
	 *
	 * @param int $preselectedYear
	 * @return $this
	 */
	public function setPreselectedYear($preselectedYear) {
		$this->preselectedYear = $preselectedYear;

		return $this;
	}

	/**
	 * Get preselected year
	 *
	 * @return int
	 */
	public function getPreselectedYear() {
		return $this->preselectedYear;
	}
} 