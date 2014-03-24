<?php
/**
 * Created by PhpStorm.
 * User: Janek
 * Date: 24.03.14
 * Time: 23:18
 */

namespace AccountsClientPHP;


class ProfileSearchResult {
	/**
	 * @var Profile[]
	 */
	protected $profiles = [];

	/**
	 * @var int
	 */
	protected $size = 0;

	public function __construct($json = null) {
		if($json !== null) {
			$profiles = [];
			foreach($json['profiles'] as $profile) {
				$profiles[] = new Profile($profile);
			}
			$this->setProfiles($profiles);
			$this->setSize($json['size']);
		}
	}

	/**
	 * @param Profile[] $profiles
	 */
	public function setProfiles($profiles) {
		$this->profiles = $profiles;
	}

	/**
	 * @return Profile[]
	 */
	public function getProfiles() {
		return $this->profiles;
	}

	/**
	 * @param int $size
	 */
	public function setSize($size) {
		$this->size = $size;
	}

	/**
	 * @return int
	 */
	public function getSize() {
		return $this->size;
	}
} 