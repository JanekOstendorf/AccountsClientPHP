<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace minecraftAccounts\repository;


use minecraftAccounts\exception\AccountNotFoundException;
use minecraftAccounts\Repository;
use minecraftAccounts\UUID;

class UUIDRepository extends Repository {

	public function fetchUUID($userName) {
		$baseUrl = 'https://api.mojang.com/profiles/minecraft';
		$request = $this->httpClient->createRequest('POST', $baseUrl, ['Content-Type' => 'application/json'], json_encode([$userName]));
		$response = $request->send();

		$json = $response->json();
		if(empty($json)) {
			throw new AccountNotFoundException();
		}

		return UUID::fromString($json[0]['id']);
	}

} 