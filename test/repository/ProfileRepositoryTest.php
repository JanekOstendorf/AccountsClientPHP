<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace repository;


use minecraftAccounts\repository\ProfileRepository;
use minecraftAccounts\UUID;

class ProfileRepositoryTest extends \PHPUnit_Framework_TestCase {

	public function testProfileFetching() {
		$profileRepository = new ProfileRepository();

		// Check instantiation
		$this->assertInstanceOf('\minecraftAccounts\repository\ProfileRepository', $profileRepository);

		// Test fetching for "Notch"
		$notchUUID = UUID::fromString('069a79f444e94726a5befca90e38aaf5');
		$this->assertInstanceOf('\minecraftAccounts\UUID', $notchUUID);

		$notchProfile = $profileRepository->fetchProfile($notchUUID);
		$this->assertEquals('Notch', $notchProfile->getUserName());
		// As the UUID for the profile object is taken from the API response, we need to check it
		$this->assertEquals($notchUUID->getArray(), $notchProfile->getUuid()->getArray());

		// The API has a connection throttle to allow one query per minute. So we need to sleep zzZZzz
		sleep(61);
	}

}
 