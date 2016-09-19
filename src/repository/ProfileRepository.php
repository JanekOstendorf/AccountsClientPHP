<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace minecraftAccounts\repository;

use GuzzleHttp\Exception\ClientException;
use minecraftAccounts\exception\AccountNotFoundException;
use minecraftAccounts\exception\TooManyRequestsException;
use minecraftAccounts\Profile;
use minecraftAccounts\Repository;
use minecraftAccounts\UUID;

/**
 * Conversion from UUID -> name
 * @package minecraftAccounts\repository
 */
class ProfileRepository extends Repository {

	public function fetchProfile(UUID $uuid) {
		$baseUrl = 'https://sessionserver.mojang.com/session/minecraft/profile/';
		$request = $this->httpClient->request('GET', $baseUrl.$uuid->getUnformatted());

		try {
			$response = (string)$request->getBody();
		} catch(ClientException $e) {
			if($e->getResponse()->getStatusCode() == 429) {
				throw new TooManyRequestsException();
			} else {
				throw $e;
			}
		}

		if($request->getStatusCode() == 204) {
			throw new AccountNotFoundException();
		}

		$json = json_decode($response, true);

		return Profile::createFromJSON($json);
	}

}