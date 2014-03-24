<?php
/**
 * @author Janek Ostendorf (ozzyfant) <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 ozzyfant
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace AccountsClientPHP;

class HTTPProfileRepository implements ProfileRepository {
	const MAX_PAGES_TO_CHECK = 1;

	/**
	 * @var \Guzzle\Http\Client
	 */
	protected $client = null;

	public function __construct(\Guzzle\Http\Client $client = null) {
		if($client !== null)
			$this->client = $client;
		else
			$this->client = new \Guzzle\Http\Client();
	}

	public function findProfilesByCriteria(ProfileCriteria $criteria) {
		try {
			$body = $criteria->toJSON();
			$profiles = [];
			for($i = 1; $i <= self::MAX_PAGES_TO_CHECK; $i++) {
				$response = $this->post('https://api.mojang.com/profiles/page/'.$i, $body, ['Content-Type', 'application/json']);
				if($response->getSize() == 0) {
					break;
				}
				$profiles = array_merge($profiles, $response->getProfiles());
			}
			return $profiles;
		} catch(\Exception $e) {
			return null;
		}
	}

	protected function post($url, $body, $headers) {
		$request = $this->client->createRequest('POST', $url, $headers, $body);
		$response = $request->send();
		return new ProfileSearchResult($response->json());
	}
}