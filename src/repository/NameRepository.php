<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace minecraftAccounts\repository;

use minecraftAccounts\AccountNotFoundException;
use minecraftAccounts\Repository;
use minecraftAccounts\UUID;

/**
 * Conversion from UUID -> name
 * @package minecraftAccounts\repository
 */
class NameRepository extends Repository {

	public function fetchUserName(UUID $uuid) {
		$baseUrl = 'https://sessionserver.mojang.com/session/minecraft/profile/';
		$request = $this->httpClient->createRequest('GET', $baseUrl.$uuid->getUnformatted());
		$response = $request->send();

		if($response->getStatusCode() == 204) {
			throw new AccountNotFoundException();
		}

		$json = $response->json();
		return $json['name'];
	}

}