<?php
use minecraftAccounts\Converter;
use minecraftAccounts\Profile;
use minecraftAccounts\UUID;

/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

class ConverterTest extends PHPUnit_Framework_TestCase {

	/*
	 * In the current state, uuidToName() and nameToUUID() are only aliases to already tested functions and
	 * will not be tested again.
	 */

	public function testProfileCompletion() {
		// Profile to check against
		$completeProfile = new Profile();
		$completeProfile->setUuid(UUID::fromString('069a79f444e94726a5befca90e38aaf5'));
		$completeProfile->setUserName('Notch');

		// Name given, UUID not
		$username = 'Notch';
		$notch = new Profile();
		$notch->setUserName($username);
		$this->assertInstanceOf('\minecraftAccounts\Profile', $notch);

		$newProfile = Converter::completeProfile($notch);
		$this->assertEquals($completeProfile, $newProfile);

		// Name given, UUID not
		$uuid = UUID::fromString('069a79f444e94726a5befca90e38aaf5');
		$notch = new Profile();
		$notch->setUUID($uuid);
		$this->assertInstanceOf('\minecraftAccounts\Profile', $notch);

		$newProfile = Converter::completeProfile($notch);
		$this->assertEquals($completeProfile, $newProfile);
	}

	public function testAlreadyCompleteProfile() {
		$username = 'Notch';
		$uuid = UUID::fromString('069a79f444e94726a5befca90e38aaf5');

		$notch = new Profile();
		$notch->setUserName($username);
		$notch->setUuid($uuid);

		$this->assertInstanceOf('\minecraftAccounts\Profile', $notch);

		$newProfile = Converter::completeProfile($notch);
		$this->assertEquals($notch, $newProfile);
	}

	public function testEmptyProfile() {
		$emptyProfile = new Profile();
		$this->assertInstanceOf('\minecraftAccounts\Profile', $emptyProfile);

		$this->setExpectedException('InvalidArgumentException');
		Converter::completeProfile($emptyProfile);
	}

}
 