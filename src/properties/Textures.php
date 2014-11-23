<?php
/**
 * Created by PhpStorm.
 * User: Janek
 * Date: 22.11.14
 * Time: 20:01
 */

namespace minecraftAccounts\properties;

use DateTime;
use minecraftAccounts\Profile;

class Textures {

	/**
	 * @var DateTime
	 */
	protected $timestamp = null;

	/**
	 * @var bool
	 */
	protected $hasSkin = false;

	/**
	 * @var bool
	 */
	protected $hasCape = false;

	/**
	 * @var string
	 */
	protected $skinURL = '';

	/**
	 * @var string
	 */
	protected $capeURL = '';

	/**
	 * @var Profile
	 */
	protected $profile = null;

	public function __construct(Profile $profile) {
		$this->profile = $profile;

		// TODO: Catch case the properties haven't been fetched yet
		$properties = $profile->getPropertiesRaw();

		$texturesRaw = null;
		// Search for textures property
		foreach($properties as $struct) {
			if($struct['name'] == 'textures')
				$texturesRaw = $struct;
			break;
		}

		$textures = json_decode(base64_decode($texturesRaw['value']), true);

		// Fill fields
		$this->timestamp = DateTime::createFromFormat('U', round($textures['timestamp']/1000));
		if(isset($textures['textures']['SKIN']['url'])) {
			$this->hasSkin = true;
			$this->skinURL = $textures['textures']['SKIN']['url'];
		}
		if(isset($textures->textures->CAPE->url)) {
			$this->hasSkin = true;
			$this->skinURL = $textures['textures']['CAPE']['url'];
		}
	}

	/**
	 * @return boolean
	 */
	public function hasCape() {
		return $this->hasCape;
	}

	/**
	 * @return boolean
	 */
	public function hasSkin() {
		return $this->hasSkin;
	}

	/**
	 * @return string
	 */
	public function getCapeURL() {
		return $this->capeURL;
	}

	/**
	 * @return string
	 */
	public function getSkinURL() {
		return $this->skinURL;
	}
} 