<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

class UUIDTest extends PHPUnit_Framework_TestCase {

	public function testUUIDFromStringCreation() {
		// Proper string. Hex and 32 digits
		$uuidString = 'c709e602680b40459dbe00e47f3f4b4b';
		$uuid = \minecraftAccounts\UUID::fromString($uuidString);
		$this->assertEquals($uuid->getArray(), ['c709e602', '680b', '4045', '9dbe', '00e47f3f4b4b']);

		// Another test with hyphens
		$uuidString = 'c709e602-680b-4045-9dbe-00e47f3f4b4b';
		$uuid = \minecraftAccounts\UUID::fromString($uuidString);
		$this->assertEquals($uuid->getArray(), ['c709e602', '680b', '4045', '9dbe', '00e47f3f4b4b']);
	}

	public function testUUIDFromStringInvalidArgument() {
		$this->setExpectedException('InvalidArgumentException');

		// False test, hyphens in the wrong position
		$uuidString = 'c709e602680b--4045-9dbe-00e47f-3f4b4b';
		$uuid = \minecraftAccounts\UUID::fromString($uuidString);
	}

	public function testCorrectUUIDOutput() {
		// Create proper UUID
		$uuidString = 'c709e602680b40459dbe00e47f3f4b4b';
		$uuid = \minecraftAccounts\UUID::fromString($uuidString);
		// Should be fine
		$this->assertEquals($uuid->getArray(), ['c709e602', '680b', '4045', '9dbe', '00e47f3f4b4b']);

		// Formats
		$this->assertEquals($uuid->getFormatted(), 'c709e602-680b-4045-9dbe-00e47f3f4b4b');
		$this->assertEquals((string)$uuid, 'c709e602-680b-4045-9dbe-00e47f3f4b4b');
		$this->assertEquals($uuid->getUnformatted(), 'c709e602680b40459dbe00e47f3f4b4b');
	}

}
 