<?php
namespace ThomasKieslich\Efblog\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011-2015 Thomas Kieslich
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the text file GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Core\SingletonInterface;

/**
 * find Avatar by Email
 */
class AvatarService implements SingletonInterface {

	/**
	 * @param $email
	 * @return array|null
	 */
	static public function findAvatarByEmail($email) {
		$avatar = NULL;
		/** @var \TYPO3\CMS\Core\Database\DatabaseConnection $database */
		$database = $GLOBALS['TYPO3_DB'];

		$select = 'image';
		$table = 'fe_users';
		$where = 'email = \'' . $email . '\'';
		$result = $database->exec_SELECTquery($select, $table, $where);
		if ($result) {
			$value = $database->sql_fetch_assoc($result);
			$avatar = explode(',', $value['image']);

			return $avatar[0];
		} else {
			return $avatar;
		}
	}
}