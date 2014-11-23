<?php
/**
 * Created by PhpStorm.
 * User: Janek
 * Date: 23.11.14
 * Time: 11:09
 */

class ProfileTest extends PHPUnit_Framework_TestCase {

	// Response for Notch's UUID. Fetched at 2014-11-23 10:17 UTC
	const NOTCH_RESPONSE = '{"id":"069a79f444e94726a5befca90e38aaf5","name":"Notch","properties":[{"name":"textures","value":"eyJ0aW1lc3RhbXAiOjE0MTY3Mzc4NDQ4NzIsInByb2ZpbGVJZCI6IjA2OWE3OWY0NDRlOTQ3MjZhNWJlZmNhOTBlMzhhYWY1IiwicHJvZmlsZU5hbWUiOiJOb3RjaCIsInRleHR1cmVzIjp7IlNLSU4iOnsidXJsIjoiaHR0cDovL3RleHR1cmVzLm1pbmVjcmFmdC5uZXQvdGV4dHVyZS9hMTE2ZTY5YTg0NWUyMjdmN2NhMWZkZGU4YzM1N2M4YzgyMWViZDRiYTYxOTM4MmVhNGExZjg3ZDRhZTk0In0sIkNBUEUiOnsidXJsIjoiaHR0cDovL3RleHR1cmVzLm1pbmVjcmFmdC5uZXQvdGV4dHVyZS8zZjY4OGUwZTY5OWIzZDlmZTQ0OGI1YmI1MGEzYTI4OGY5YzU4OTc2MmIzZGFlODMwODg0MjEyMmRjYjgxIn19fQ=="}]}';

	public function testProfileFetching() {
		$notchUUID = \minecraftAccounts\UUID::fromString('069a79f444e94726a5befca90e38aaf5');

		$notchByName = \minecraftAccounts\Profile::createFromName('Notch');
		$this->assertEquals('Notch', $notchByName->getUserName());
		$this->assertEquals($notchUUID->getArray(), $notchByName->getUuid()->getArray());

		// The API has a connection throttle to allow one query per minute. So we need to sleep zzZZzz
		sleep(61);

		$notchByUUID = \minecraftAccounts\Profile::createFromUUID($notchUUID);
		$this->assertEquals('Notch', $notchByUUID->getUserName());
		$this->assertEquals($notchUUID->getArray(), $notchByUUID->getUuid()->getArray());

		// The API has a connection throttle to allow one query per minute. So we need to sleep zzZZzz
		sleep(61);

		$notchByJSON = \minecraftAccounts\Profile::createFromJSON(json_decode(self::NOTCH_RESPONSE, true));
		$this->assertEquals('Notch', $notchByJSON->getUserName());
		$this->assertEquals($notchUUID->getArray(), $notchByJSON->getUuid()->getArray());

		// The API has a connection throttle to allow one query per minute. So we need to sleep zzZZzz
		sleep(61);
	}

}
 