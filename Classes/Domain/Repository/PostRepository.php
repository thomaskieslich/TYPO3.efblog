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
 * Repository for Tx_Efblog_Domain_Model_Post
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Efblog_Domain_Repository_PostRepository extends Tx_Extbase_Persistence_Repository {

	public function findPosts($settings) {
		$query = $this->createQuery();

		$constraints = $this->createConstraintsFromSettings($query, $settings);
		if ($constraints) {
			$query->matching(
					$query->logicalAnd($constraints)
			);
		}

		//Ordering
		if ($orderings = $this->createOrderingsfromSettings($settings)) {
			$query->setOrderings($orderings);
		}

		//Limit		
		if ($settings['listView']['maxEntries'] > 0) {
			$query->setLimit((int) $settings['listView']['maxEntries']);
		}

		return $query->execute();
	}

	//Utilities
	protected function createConstraintsfromSettings(Tx_Extbase_Persistence_QueryInterface $query, $settings) {
		$constraints = array();

		//categories
		if ($settings['listView']['category'] || $settings['listView']['hideNoCategorized'] == 1) {
			$constraints[] = $this->createCategoryConstraint($query, $settings);
		}

		//search
		if ($settings['listView']['searchPhrase']) {
			$constraints[] = $this->createSearchConstraint($query, $settings);
		}

		//date
		if ($this->createDateTimeConstraint($query, $settings)) {
			$constraints[] = $this->createDateTimeConstraint($query, $settings);
		}

		//archive
		if ($settings['listView']['displayArchived']) {
			$constraints[] = $this->createArchiveConstraint($query, $settings);
		}

		return $constraints;
	}

	/**
	 * dateTime constraints
	 * @param Tx_Extbase_Persistence_QueryInterface $query
	 * @param array $settings
	 * @return array 
	 */
	protected function createDateTimeConstraint(Tx_Extbase_Persistence_QueryInterface $query, $settings) {
		$constraints = NULL;
		$dateConstraints = array();
		$today = time();

		//no future posts
		if ($settings['enableFuturePosts'] == 0) {
			$dateConstraints[] = $query->lessThan('date', $today);
		}

		
		if ($settings['startDate']) {
			$dateConstraints[] = $query->greaterThanOrEqual('date', $settings['startDate']);
		}
		
		$start = '';
		$stop = '';
		
		if($settings['year']){
			$date = $settings['year'].'-1-1';
			$start = strtotime($date);
			$stop = strtotime('+1 year', strtotime($date));
		}
		
		if($settings['month']){
			$date = $settings['year'].'-'.$settings['month'].'-1';
			$start = strtotime($date);
			$stop = strtotime('+1 month', strtotime($date));
		}
		
		if($settings['day']){
			$date = $settings['year'].'-'.$settings['month'].'-'.$settings['day'];
			$start = strtotime($date);
			$stop = strtotime('+1 day', strtotime($date));
		}
		
		if ($settings['year'] || $settings['month'] || $settings['day']) {
			$dateConstraints[] = $query->logicalAnd(
							$query->greaterThanOrEqual('date', $start), $query->lessThanOrEqual('date', $stop)
			);
		}

		if ($dateConstraints) {
			$constraints = $query->logicalAnd($dateConstraints);
		}
		return $constraints;
	}

	/**
	 * set constraints for archived posts
	 * @param Tx_Extbase_Persistence_QueryInterface $query
	 * @param array $settings
	 * @return array 
	 */
	protected function createArchiveConstraint(Tx_Extbase_Persistence_QueryInterface $query, $settings) {
		$constraints = NULL;
		$archiveConstraints = array();

		$archiveMode = $settings['listView']['displayArchived'];
		// daysToArchive
		if ($settings['listView']['daysToArchive']) {
			$archiveDate = mktime(0, 0, 0, date("m"), date("d") - (int) $settings['listView']['daysToArchive'], date("Y"));

			if ($archiveMode == 'archived') {
				$archiveConstraints[] = $query->lessThan('date', $archiveDate);
			} elseif ($archiveMode == 'active') {
				$archiveConstraints[] = $query->greaterThanOrEqual('date', $archiveDate);
			}
		}
		// archived
		else {
			if ($archiveMode == 'archived') {
				$archiveConstraints[] = $query->logicalAnd(
								$query->lessThan('archive', $GLOBALS['EXEC_TIME']), $query->greaterThan('archive', 0)
				);
			} elseif ($archiveMode == 'active') {
				$archiveConstraints[] = $query->logicalOr(
								$query->greaterThanOrEqual('archive', $GLOBALS['EXEC_TIME']), $query->equals('archive', 0)
				);
			}
		}

		if ($archiveConstraints) {
			$constraints = $query->logicalAnd($archiveConstraints);
		}
		return $constraints;
	}

	protected function createCategoryConstraint(Tx_Extbase_Persistence_QueryInterface $query, $settings) {
		$constraint = NULL;
		$categories = NULL;
		$categoryConstraints = array();
		if ($settings['listView']['category']) {
			$categories = t3lib_div::trimExplode(',', $settings['listView']['category'], TRUE);
		} else {
			$categoryRepository = $this->objectManager->get('Tx_Efblog_Domain_Repository_CategoryRepository');
			$categories = $categoryRepository->findAll();
		}


		foreach ($categories as $category) {
			$categoryConstraints[] = $query->contains('categories', $category);
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
				$constraint = $query->logicalAnd($categoryConstraints);
				break;
			default:
				$constraint = $query->logicalOr($categoryConstraints);
		}

		return $constraint;
	}

	protected function createSearchConstraint(Tx_Extbase_Persistence_QueryInterface $query, $settings) {

		$constraint = NULL;
		$searchConstraints = array();
		$terms = t3lib_div::trimExplode(' ', $settings['listView']['searchPhrase'], TRUE);
		$fields = t3lib_div::trimExplode(',', $settings['listView']['searchFields'], TRUE);

		foreach ($terms as $term) {
			foreach ($fields as $field) {
				$searchConstraints[] = $query->like($field, '%' . $term . '%');
			}
		}
		$constraint = $query->logicalOr($searchConstraints);
		return $constraint;
	}

	protected function createOrderingsfromSettings($settings) {
		$orderings = array();
		$orderList = t3lib_div::trimExplode(',', $settings['listView']['orderBy'], TRUE);
		$sortList = t3lib_div::trimExplode(',', $settings['listView']['sortDirection'], FALSE);

		if (!empty($orderList)) {
			foreach ($orderList as $orderNum => $orderItem) {
				if ($sortList[$orderNum]) {
					$orderings[$orderItem] = ((strtolower($sortList[$orderNum]) == 'desc') ?
									Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING :
									Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING);
				} else {
					$orderings[$orderItem] = Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING;
				}
			}
		}
		return $orderings;
	}

	public function countCategoryPosts(Tx_Efblog_Domain_Model_Category $category) {
		$query = $this->createQuery();
		$query->matching(
				$query->contains('categories', $category)
		);
		return $query->execute();
	}

	public function searchPost($searchString = '') {
		$query = $this->createQuery();

		$terms = t3lib_div::trimExplode(' ', $searchString, TRUE);
		$constraints = array();
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