<?php
/**
 * @author Janek Ostendorf (ozzyfant) <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 ozzyfant
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

require_once 'vendor/autoload.php';

// Create an empty profile
$player = new \minecraftAccounts\Profile();
// Set the user name
$player->setUserName('ozzy2345');

// The Converter might throw some exceptions, catch them
try {
	$player = \minecraftAccounts\Converter::completeProfile($player);
} catch(\minecraftAccounts\AccountNotFoundException $e) {
	echo 'This account could\'t be found.';
} catch(InvalidArgumentException $e) {
	echo 'You need to specify at least user name or UUID on your player.';
}

var_dump($player->getUserName()); // ozzy2345
var_dump($player->getUuid()->getFormatted()); // c709e602-680b-4045-9dbe-00e47f3f4b4b