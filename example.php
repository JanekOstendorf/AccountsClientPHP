<?php
/**
 * @author Janek Ostendorf (ozzyfant) <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 ozzyfant
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

use minecraftAccounts\exception\AccountNotFoundException;
use minecraftAccounts\exception\TooManyRequestsException;
use minecraftAccounts\Profile;
use minecraftAccounts\UUID;

require_once 'vendor/autoload.php';

/*
 * Create a profile by known name
 *
 * Fetches the UUID from the Mojang API first, then fetches the profile using this UUID from the API.
 * Returns a complete profile.
 *
 * If it fails to fetch data from the API, exceptions will be thrown.
 */
try {
	$profile = Profile::createFromName('ozzyfant');
} catch(AccountNotFoundException $e) {
	exit('This account does not exist.');
} catch(TooManyRequestsException $e) {
	exit('Mojang API limits to 1 request per minute. Please build a cache.');
}

/*
 * Alternative: Create a profile by known UUID
 *
 * Like above, returns a complete profile. But this skips the Name -> UUID resolution.
 * Needs to use the UUID class.
 */
//$alternative = Profile::createFromUUID(UUID::fromString('afb648d8-8404-435a-8d52-8edf51516666'));

var_dump($profile->getUserName()); // ozzyfant
var_dump($profile->getUuid()->getFormatted()); // afb648d8-8404-435a-8d52-8edf51516666

// Get information about textures (skin, cape)
$ozzyTextures = $profile->getTextures();

var_dump($ozzyTextures->getSkinURL());
