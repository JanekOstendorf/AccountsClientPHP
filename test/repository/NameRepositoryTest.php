<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace repository;


use minecraftAccounts\repository\ProfileRepository;
use minecraftAccounts\UUID;

class NameRepositoryTest extends \PHPUnit_Framework_TestCase {

	public function testProperNameConversion() {
		$uuid = UUID::fromString('069a79f444e94726a5befca90e38aaf5'); // Notch
		$repository = new ProfileRepository();

		// Check if instanced correctly
		$this->assertInstanceOf('\minecraftAccounts\repository\NameRepository', $repository);

		// Really convert something
		$username = $repository->fetchUserName($uuid);
		$this->assertEquals('Notch', $username);
	}

	public function testNotExistingID() {
		$uuid = UUID::fromString('792d656760cb33281a98c5cb0a49c34f'); // I hope this will never exist
		$repository = new ProfileRepository();

		// Check if instanced correctly
		$this->assertInstanceOf('\minecraftAccounts\repository\NameRepository', $repository);

		$this->setExpectedException('\minecraftAccounts\AccountNotFoundException');
		$username = $repository->fetchUserName($uuid);
		$this->assertNull($username);
	}

}
 