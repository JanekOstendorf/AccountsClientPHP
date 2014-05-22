<?php
/**
 * @author Janek Ostendorf (ozzyfant) <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 ozzyfant
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

require_once 'vendor/autoload.php';

// Examples will be here
$player = new \minecraftAccounts\Profile();
$player->setUserName('ozzy2345');

try {
	\minecraftAccounts\Converter::completeProfile($player);
} catch(\minecraftAccounts\AccountNotFoundException $e) {
	echo 'This account could\'t be found.';
}

print_r($player->getUserName()); // ozzy2345
print_r((string)$player->getUuid()); // c709e602-680b-4045-9dbe-00e47f3f4b4b