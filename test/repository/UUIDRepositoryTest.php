<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace repository;


use minecraftAccounts\repository\UUIDRepository;
use minecraftAccounts\UUID;

class UUIDRepositoryTest extends \PHPUnit_Framework_TestCase {

	public function testProperIDConversion() {
		$username = 'Notch';
		$repository = new UUIDRepository();

		// Check if instanced correctly
		$this->assertInstanceOf('\minecraftAccounts\repository\UUIDRepository', $repository);

		// Really convert something
		$uuid = $repository->fetchUUID($username);
		$this->assertInstanceOf('\minecraftAccounts\UUID', $uuid);
		$this->assertEquals($uuid, UUID::fromString('069a79f444e94726a5befca90e38aaf5'));
	}

	public function testNotExistingName() {
		$username = '22a_63ypM4u5';
		$repository = new UUIDRepository();

		// Check if instanced correctly
		$this->assertInstanceOf('\minecraftAccounts\repository\UUIDRepository', $repository);

		$this->setExpectedException('\minecraftAccounts\AccountNotFoundException');
		$uuid = $repository->fetchUUID($username);
		$this->assertNull($uuid);
	}

}
 