<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 
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
 * Repository for Tx_Tkblog_Domain_Model_Post
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Tkblog_Domain_Repository_PostRepository extends Tx_Extbase_Persistence_Repository {

	public function findPosts($limit, $archived) {
		$query = $this->createQuery();
			// archived
		if ($archived == 'none') {
			$constraints[] = $query->logicalOr(
				$query->lessThan('archive', $GLOBALS['EXEC_TIME']),
				$query->greaterThan('archive', 0)
			);
		} elseif ($archived == 'archived') {
			$constraints[] = $query->greaterThanOrEqual('archive', $GLOBALS['EXEC_TIME']);
		}
		if($constraints){
		$query->matching(
				$query->logicalAnd($constraints)
			);
		}
		
		$query->setOrderings(
				array (
					'date' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
				)
		);
		if ($limit > 0) {
			$query->setLimit($limit);
		}
		return $query->execute();
	}

	public function findLatest($limit) {
		$query = $this->createQuery();
		$query->setOrderings(
				array (
					'date' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
				)
		);
		$query->setLimit($limit);

		return $query->execute();
	}

	public function findViews($limit) {
		$query = $this->createQuery();
		$query->setOrderings(
				array (
					'views' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING
				)
		);
		$query->setLimit($limit);

		return $query->execute();
	}

}

?>