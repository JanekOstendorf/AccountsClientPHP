<?php
/**
 * Created by PhpStorm.
 * User: Janek
 * Date: 23.11.14
 * Time: 11:31
 */

namespace properties;


use minecraftAccounts\Profile;

class TexturesTest extends \PHPUnit_Framework_TestCase {

	public function testTextures() {
		// Real profile of Notch as of 2014-11-23 10:17 UTC
		$notchAll = Profile::createFromJSON(json_decode('{"id":"069a79f444e94726a5befca90e38aaf5","name":"Notch","properties":[{"name":"textures","value":"eyJ0aW1lc3RhbXAiOjE0MTY3Mzc4NDQ4NzIsInByb2ZpbGVJZCI6IjA2OWE3OWY0NDRlOTQ3MjZhNWJlZmNhOTBlMzhhYWY1IiwicHJvZmlsZU5hbWUiOiJOb3RjaCIsInRleHR1cmVzIjp7IlNLSU4iOnsidXJsIjoiaHR0cDovL3RleHR1cmVzLm1pbmVjcmFmdC5uZXQvdGV4dHVyZS9hMTE2ZTY5YTg0NWUyMjdmN2NhMWZkZGU4YzM1N2M4YzgyMWViZDRiYTYxOTM4MmVhNGExZjg3ZDRhZTk0In0sIkNBUEUiOnsidXJsIjoiaHR0cDovL3RleHR1cmVzLm1pbmVjcmFmdC5uZXQvdGV4dHVyZS8zZjY4OGUwZTY5OWIzZDlmZTQ0OGI1YmI1MGEzYTI4OGY5YzU4OTc2MmIzZGFlODMwODg0MjEyMmRjYjgxIn19fQ=="}]}', true));
		$this->assertTrue($notchAll->getTextures()->hasSkin());
		$this->assertEquals('http://textures.minecraft.net/texture/a116e69a845e227f7ca1fdde8c357c8c821ebd4ba619382ea4a1f87d4ae94', $notchAll->getTextures()->getSkinURL());
		$this->assertTrue($notchAll->getTextures()->hasCape());
		$this->assertEquals('http://textures.minecraft.net/texture/3f688e0e699b3d9fe448b5bb50a3a288f9c589762b3dae8308842122dcb81', $notchAll->getTextures()->getCapeURL());

		$notchWithoutCape = Profile::createFromJSON(json_decode('{"id":"069a79f444e94726a5befca90e38aaf5","name":"Notch","properties":[{"name":"textures","value":"eyJ0aW1lc3RhbXAiOjE0MTY3Mzc4NDQ4NzIsInByb2ZpbGVJZCI6IjA2OWE3OWY0NDRlOTQ3MjZhNWJlZmNhOTBlMzhhYWY1IiwicHJvZmlsZU5hbWUiOiJOb3RjaCIsInRleHR1cmVzIjp7IlNLSU4iOnsidXJsIjoiaHR0cDovL3RleHR1cmVzLm1pbmVjcmFmdC5uZXQvdGV4dHVyZS9hMTE2ZTY5YTg0NWUyMjdmN2NhMWZkZGU4YzM1N2M4YzgyMWViZDRiYTYxOTM4MmVhNGExZjg3ZDRhZTk0In19fQ=="}]}', true));
		$this->assertTrue($notchWithoutCape->getTextures()->hasSkin());
		$this->assertEquals('http://textures.minecraft.net/texture/a116e69a845e227f7ca1fdde8c357c8c821ebd4ba619382ea4a1f87d4ae94', $notchWithoutCape->getTextures()->getSkinURL());
		$this->assertFalse($notchWithoutCape->getTextures()->hasCape());
		$this->assertEquals('', $notchWithoutCape->getTextures()->getCapeURL());

		$notchWithoutSkin = Profile::createFromJSON(json_decode('{"id":"069a79f444e94726a5befca90e38aaf5","name":"Notch","properties":[{"name":"textures","value":"eyJ0aW1lc3RhbXAiOjE0MTY3Mzc4NDQ4NzIsInByb2ZpbGVJZCI6IjA2OWE3OWY0NDRlOTQ3MjZhNWJlZmNhOTBlMzhhYWY1IiwicHJvZmlsZU5hbWUiOiJOb3RjaCIsInRleHR1cmVzIjp7IkNBUEUiOnsidXJsIjoiaHR0cDovL3RleHR1cmVzLm1pbmVjcmFmdC5uZXQvdGV4dHVyZS8zZjY4OGUwZTY5OWIzZDlmZTQ0OGI1YmI1MGEzYTI4OGY5YzU4OTc2MmIzZGFlODMwODg0MjEyMmRjYjgxIn19fQ=="}]}', true));
		$this->assertFalse($notchWithoutSkin->getTextures()->hasSkin());
		$this->assertEquals('', $notchWithoutSkin->getTextures()->getSkinURL());
		$this->assertTrue($notchWithoutSkin->getTextures()->hasCape());
		$this->assertEquals('http://textures.minecraft.net/texture/3f688e0e699b3d9fe448b5bb50a3a288f9c589762b3dae8308842122dcb81', $notchWithoutSkin->getTextures()->getCapeURL());

		$notchNothing = Profile::createFromJSON(json_decode('{"id":"069a79f444e94726a5befca90e38aaf5","name":"Notch","properties":[{"name":"textures","value":"eyJ0aW1lc3RhbXAiOjE0MTY3Mzc4NDQ4NzIsInByb2ZpbGVJZCI6IjA2OWE3OWY0NDRlOTQ3MjZhNWJlZmNhOTBlMzhhYWY1IiwicHJvZmlsZU5hbWUiOiJOb3RjaCIsInRleHR1cmVzIjp7fX19"}]}', true));
		$this->assertFalse($notchNothing->getTextures()->hasSkin());
		$this->assertEquals('', $notchNothing->getTextures()->getSkinURL());
		$this->assertFalse($notchNothing->getTextures()->hasCape());
		$this->assertEquals('', $notchNothing->getTextures()->getCapeURL());

	}

}
 