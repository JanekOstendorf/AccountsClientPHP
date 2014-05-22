<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace minecraftAccounts;

/**
 * Represents a Minecraft Profile
 * @package minecraftAccounts
 */
class Profile {

	/**
	 * Minecraft user name
	 * @var string
	 */
	protected $userName = '';

	/**
	 * Minecraft UUID
	 * @var UUID
	 */
	protected $uuid = null;

	/**
	 * @param string $userName
	 */
	public function setUserName($userName) {
		$this->userName = $userName;
	}

	/**
	 * @return string
	 */
	public function getUserName() {
		return $this->userName;
	}

	/**
	 * @param UUID $uuid
	 */
	public function setUuid(UUID $uuid) {
		$this->uuid = $uuid;
	}

	/**
	 * @return UUID
	 */
	public function getUuid() {
		return $this->uuid;
	}

} 