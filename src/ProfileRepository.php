<?php
/**
 * @author Janek Ostendorf (ozzyfant) <ozzy@ozzyfant.de>
 * @copyright Copyright (c) 2014 ozzyfant
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License, version 3
 */

namespace AccountsClientPHP;

interface ProfileRepository {
	public function findProfilesByCriteria(ProfileCriteria $criteria);
} 