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
 * Repository for Tx_Efblog_Domain_Model_Category
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Efblog_Domain_Repository_CategoryRepository extends Tx_Extbase_Persistence_Repository {

	public function findMainCategories ($settings) {
		$query = $this->createQuery();
		$constraint = NULL;
		if ($settings['listView']['category']) {
			$constraint = $query->logicalAnd(
				$this->createCategoryConstraint($query, $settings), 
				$query->equals('parent_category', 0)
			);
		} else {
			$constraint = $query->equals('parent_category', 0);
		}
		
		$query->matching(
			$constraint
		);
		$query->setOrderings(
			array (
				'title' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
			)
		);

		return $query->execute();
	}

	public function findChilds (Tx_Efblog_Domain_Model_Category $category) {
		$query = $this->createQuery();
		$query->matching(
			$query->equals('parent_category', $category)
		);
		$query->setOrderings(
			array (
				'title' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
			)
		);
		return $query->execute();
	}

	protected function createCategoryConstraint (Tx_Extbase_Persistence_QueryInterface $query, $settings) {
		$constraint = NULL;
		$categoryConstraints = array ();
		$categories = t3lib_div::trimExplode(',', $settings['listView']['category'], TRUE);

		foreach ($categories as $category) {
			$categoryConstraints[] = $query->equals('uid', $category);
		}

		switch (strtolower($settings['listView']['categoryMode'])) {
			case 'or':
				$constraint = $query->logicalOr($categoryConstraints);
				break;
			case 'notor':
				$constraint = $query->logicalNot($query->logicalOr($categoryConstraints));
				break;
			case 'notand':
				$constraint = $query->logicalNot($query->logicalAnd($categoryConstraints));
				break;
			case 'and':
			default:
				$constraint = $query->logicalAnd($categoryConstraints);
		}
		return $constraint;
	}

}