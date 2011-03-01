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

	public function findPosts($settings) {
//		var_dump($settings);
		$query = $this->createQuery();

		if ($constraints = $this->createConstraintsFromSettings($query, $settings)) {
			$query->matching(
					$query->logicalAnd($constraints)
			);
		}

		//Ordering
		if ($orderings = $this->createOrderingsfromSettings($settings['displayList'])) {
			$query->setOrderings($orderings);
		}

		//Limit
		if ($settings['displayList']['maxEntrys'] > 0) {
			$query->setLimit((int) $settings['displayList']['maxEntrys']);
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

	//Utilities
	protected function createConstraintsfromSettings(Tx_Extbase_Persistence_QueryInterface $query, $settings) {
		$constraints = array ();

		//categories
		if ($settings['displayList']['category']) {
			$constraints[] = $this->createCategoryConstraint($query, $settings);
		}

		//search
		if ($settings['displayList']['searchPhrase']) {
			$constraints[] = $this->createSearchConstraint($query, $settings);
		}
		
		//Month
		if ($settings['displayList']['year'] > 0 && $settings['displayList']['month'] > 0) {
			$begin = mktime(0, 0, 0, $settings['displayList']['month'], 0, $settings['displayList']['year']);
			$end = mktime(0, 0, 0, ($settings['displayList']['month'] + 1), 0, $settings['displayList']['year']);

			$constraints[] = $query->logicalAnd(
					$query->greaterThanOrEqual('date', $begin),
					$query->lessThanOrEqual('date', $end)
				);
		}

		$archiveMode = $settings['displayList']['displayArchived'];
		// daysToArchive
		if ($settings['daysToArchive']) {
			$archiveDate = mktime(0, 0, 0, date("m"), date("d") - (int) $settings['daysToArchive'], date("Y"));

			if ($archiveMode == 'archived') {
				$constraints[] = $query->lessThan('date', $archiveDate);
			}
			elseif ($archiveMode == 'active') {
				$constraints[] = $query->greaterThanOrEqual('date', $archiveDate);
			}
		}
		// archived
		else {
			if ($archiveMode == 'archived') {
				$constraints[] = $query->logicalAnd(
								$query->lessThan('archive', $GLOBALS['EXEC_TIME']), $query->greaterThan('archive', 0)
				);
			}
			elseif ($archiveMode == 'active') {
				$constraints[] = $query->logicalOr(
								$query->greaterThanOrEqual('archive', $GLOBALS['EXEC_TIME']), $query->equals('archive', 0)
				);
			}
		}


		return $constraints;
	}

	protected function createCategoryConstraint(Tx_Extbase_Persistence_QueryInterface $query, $settings) {
		$constraint = NULL;
		$categoryConstraints = array ();
		$categories = t3lib_div::trimExplode(',', $settings['displayList']['category'], TRUE);

		foreach ($categories as $category) {
			$categoryConstraints[] = $query->contains('category', $category);
		}

		$constraint = $query->logicalOr($categoryConstraints);

		return $constraint;
	}

	protected function createSearchConstraint(Tx_Extbase_Persistence_QueryInterface $query, $settings) {
		$constraint = NULL;
		$searchConstraints = array ();
		$terms = t3lib_div::trimExplode(' ', $settings['displayList']['searchPhrase'], TRUE);
		$fields = t3lib_div::trimExplode(',', $settings['displayList']['searchFields'], TRUE);

		foreach ($terms as $term) {
			foreach ($fields as $field) {
				$searchConstraints[] = $query->like($field, '%' . $term . '%');
			}
		}

		$constraint = $query->logicalOr($searchConstraints);
		return $constraint;
	}

	protected function createOrderingsfromSettings($settings) {
		$orderings = array ();
		$orderList = t3lib_div::trimExplode(',', $settings['orderBy'], TRUE);
		$sortList = t3lib_div::trimExplode(',', $settings['sortDirection'], FALSE);

		if (!empty($orderList)) {
			foreach ($orderList as $orderNum => $orderItem) {
				if ($sortList[$orderNum]) {
					$orderings[$orderItem] = ((strtolower($sortList[$orderNum]) == 'desc') ?
									Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING :
									Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING);
				}
				else {
					$orderings[$orderItem] = Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING;
				}
			}
		}
		return $orderings;
	}

	public function countCategoryPosts(Tx_Tkblog_Domain_Model_Category $category) {
		$query = $this->createQuery();
		$query->matching(
				$query->contains('category', $category)
		);
		return $query->execute()->count();
	}

	public function searchPost($searchString = '') {
		$query = $this->createQuery();

		$terms = t3lib_div::trimExplode(' ', $searchString, TRUE);
		$constraints = array ();
		if ($terms) {
			foreach ($terms as $term) {
				$constraints[] = $query->like('title', '%' . $term . '%');
				$constraints[] = $query->like('content.header', '%' . $term . '%');
				$constraints[] = $query->like('content.bodytext', '%' . $term . '%');
			}
		}
		$query->matching(
				$query->logicalOr($constraints)
		);

		return $query->execute();
	}

}

?>