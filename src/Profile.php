<?php
/**
 * @author Janek Ostendorf (ozzyfant) <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 ozzyfant
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace AccountsClientPHP;

class Profile {
	/**
	 * UUID
	 * @var string
	 */
	protected $id = '';

	/**
	 * Username
	 * @var string
	 */
	protected $name = '';

	public function __construct($json = null) {
		if($json !== null) {
			$this->setID($json['id']);
			$this->setName($json['name']);
		}
	}

	/**
	 * @param string $id
	 */
	public function setID($id) {
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getID() {
		return $this->id;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
} 