<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
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
		if(isset($textures['textures']['CAPE']['url'])) {
			$this->hasCape = true;
			$this->capeURL = $textures['textures']['CAPE']['url'];
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