<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace minecraftAccounts;

/*
 * UUID Format: hex, 8-4-4-4-12. 32 digits
 */

/**
 * Simple UUID implementation for conversion
 * @package minecraftAccounts
 */
class UUID {

	/**
	 * @var array
	 */
	protected $uuid = [];

	/**
	 * @param array $uuid
	 */
	protected function __construct($uuid) {
		$this->uuid = $uuid;
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return implode('-', $this->uuid);
	}

	/**
	 * @return array
	 */
	public function getArray() {
		return $this->uuid;
	}

	/**
	 * @return string
	 */
	public function getFormatted() {
		return (string)$this;
	}

	/**
	 * @return string
	 */
	public function getUnformatted() {
		return implode('', $this->uuid);
	}

	/**
	 * @param $string
	 * @return UUID
	 * @throws \InvalidArgumentException
	 */
	public static function fromString($string) {
		// Check format
		if(preg_match('/^([a-f0-9]{8})\-?([a-f0-9]{4})\-?([a-f0-9]{4})\-?([a-f0-9]{4})\-?([a-f0-9]{12})$/i', $string, $matches) == 1) {
			// Remove 1st value (full subject)
			array_shift($matches);
			return new UUID($matches);
		} else {
			throw new \InvalidArgumentException('The given string is no valid UUID.');
		}
	}
} 