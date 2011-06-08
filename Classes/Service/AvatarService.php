<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AvatarService
 *
 * @author Thomas
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
