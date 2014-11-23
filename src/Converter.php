<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace minecraftAccounts;

use minecraftAccounts\repository\ProfileRepository;
use minecraftAccounts\repository\UUIDRepository;

/**
 * Converter. Main part of the library. Capable of converting names -> UUID and UUID -> name.
 * @package minecraftAccounts
 */
class Converter {

	/**
	 * @var ProfileRepository
	 */
	protected static $profileRepository = null;

	/**
	 * @var UUIDRepository
	 */
	protected static $uuidRepository = null;

	public static function fetchProfile(UUID $uuid) {
		if(self::$profileRepository === null)
			self::$profileRepository = new ProfileRepository();

		return self::$profileRepository->fetchProfile($uuid);
	}

	/**
	 * Converts a user name to UUID
	 * @param string $userName
	 * @return \minecraftAccounts\UUID
	 */
	public static function nameToUUID($userName) {
		if(self::$uuidRepository === null)
			self::$uuidRepository = new UUIDRepository();

		return self::$uuidRepository->fetchUUID($userName);
	}


} 