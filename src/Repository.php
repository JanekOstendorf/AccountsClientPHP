<?php
/**
 * @author    Janek "ozzyfant" Ostendorf <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 Janek Ostendorf
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace minecraftAccounts;

use GuzzleHttp\Client;

/**
 * Class Repository. Mother class for Name- and UUID-Repos
 * @package minecraftAccounts
 */
abstract class Repository {

	protected $httpClient = null;

	public function __construct(Client $httpClient = null) {
		if(is_null($httpClient))
			$this->httpClient = new Client();
		else
			$this->httpClient = $httpClient;
	}

} 