<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace minecraftAccounts;
use minecraftAccounts\properties\Textures;

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
	 * Raw properties from response
	 * @var array
	 */
	protected $propertiesRaw = [];

	/**
	 * @var Textures
	 */
	protected $textures = null;

	/**
	 * @return string
	 */
	public function getUserName() {
		return $this->userName;
	}

	/**
	 * @return UUID
	 */
	public function getUuid() {
		return $this->uuid;
	}

	/**
	 * @return array
	 */
	public function getPropertiesRaw() {
		return $this->propertiesRaw;
	}

	/**
	 * @return Textures
	 */
	public function getTextures() {
		if($this->textures === null)
			$this->textures = new Textures($this);
		return $this->textures;
	}

	/**
	 * @param array $json Response JSON from API
	 * @return Profile
	 * @throws \InvalidArgumentException
	 */
	public static function createFromJSON($json) {
		if($json === null)
			throw new \InvalidArgumentException('Input needs to be JSON.');

		// Read
		$profile = new Profile();
		$profile->uuid = UUID::fromString($json['id']);
		$profile->userName = $json['name'];
		$profile->propertiesRaw = $json['properties'];

		return $profile;
	}

	/**
	 * @param $userName
	 * @return Profile
	 */
	public static function createFromName($userName) {
		// Fetch UUID first
		$uuid = Converter::nameToUUID($userName);

		return self::createFromUUID($uuid);
	}

	/**
	 * @param UUID $uuid
	 * @return Profile
	 */
	public static function createFromUUID(UUID $uuid) {
		return Converter::fetchProfile($uuid);
	}
} 