<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Kieslich <thomaskieslich@gmx.net>
 *  	
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * fin Avatar by Email
 * 
 * @package Efblog
 * @subpackage Service
 */
class Tx_Efblog_Service_AvatarService implements t3lib_Singleton {

	public function findAvatarByEmail ($email) {
		$avatar = NULL;

		$select = 'image';
		$table = 'fe_users';
		$where = 'email = \'' . $email . '\'';
		$result = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select, $table, $where);
		if ($result) {
			$value = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result);
			$avatar = explode(',', $value['image']);
			return $avatar[0];
		} else {
			return $avatar;
		}
	}

}

?>
