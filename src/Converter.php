<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace minecraftAccounts;

use minecraftAccounts\repository\NameRepository;
use minecraftAccounts\repository\UUIDRepository;

/**
 * Converter. Main part of the library. Capable of converting names -> UUID and UUID -> name.
 * @package minecraftAccounts
 */
class Converter {

	protected static $nameRepository = null;
	protected static $uuidRepository = null;

	/**
	 * Completes a profiles. Decides whether to query for name of UUID
	 * @param Profile $profile
	 * @throws \InvalidArgumentException
	 * @return Profile
	 */
	public static function completeProfile(Profile $profile) {
		// Is there even one needed argument?
		if($profile->getUserName() == '' && $profile->getUuid() == null)
			throw new \InvalidArgumentException();

		if($profile->getUserName() != '' && $profile->getUuid() == null)
			$profile->setUuid(self::nameToUUID($profile->getUserName()));
		elseif($profile->getUserName() == '' && $profile->getUuid() != null)
			$profile->setUserName(self::uuidToName($profile->getUuid()));

		return $profile;
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

	/**
	 * Converts a UUID to user name
	 * @param \minecraftAccounts\UUID $uuid
	 * @return string
	 */
	public static function uuidToName(UUID $uuid) {
		if(self::$nameRepository === null)
			self::$nameRepository = new NameRepository();

		return self::$nameRepository->fetchUserName($uuid);
	}

} 