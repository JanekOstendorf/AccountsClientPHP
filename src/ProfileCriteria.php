<?php
/**
 * @author Janek Ostendorf (ozzyfant) <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 ozzyfant
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace AccountsClientPHP;

class ProfileCriteria {
	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var string
	 */
	protected $agent = '';

	/**
	 * @param string $name
	 * @param string $agent
	 */
	public function __construct($name, $agent) {
		$this->agent = $agent;
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getAgent() {
		return $this->agent;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	public function toJSON() {
		return json_encode(get_object_vars($this));
	}

} 