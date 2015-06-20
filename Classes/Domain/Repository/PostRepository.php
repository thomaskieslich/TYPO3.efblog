<?php
namespace ThomasKieslich\Efblog\Domain\Repository;

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
use ThomasKieslich\Efblog\Domain\Model\Category;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for ThomasKieslich\Efblog\Domain\Model\Post
 */
class PostRepository extends Repository {

	/**
	 * find posts by Settings
	 *
	 * @param array $settings
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findPosts($settings) {
		$query = $this->createQuery();

		$constraints = $this->createConstraintsFromSettings($query, $settings);
		if ($constraints) {
			$query->matching(
					$query->logicalAnd($constraints)
			);
		}

		//Ordering
		if (($orderings = $this->createOrderingsfromSettings($settings))) {
			$query->setOrderings($orderings);
		}

		//Limit
		if ($settings['listView']['maxEntries'] > 0) {
			$query->setLimit((int)$settings['listView']['maxEntries']);
		}

		return $query->execute();
	}

	//Utilities
	/**
	 * @param QueryInterface $query
	 * @param $settings
	 * @return array
	 */
	protected function createConstraintsfromSettings(QueryInterface $query, $settings) {
		$constraints = array();

		//categories
		if ($settings['listView']['category'] || $settings['listView']['hideNoCategorized'] == 1) {
			$constraints[] = $this->createCategoryConstraint($query, $settings);
		}

		//search
		if ($settings['searchList']['searchPhrase']) {
			$constraints[] = $this->createSearchConstraint($query, $settings);
		}

//		DebuggerUtility::var_dump($settings);
		//date
		if ($settings['year'] || $settings['month'] || $settings['day'] || $settings['enableFuturePosts'] == 0) {
			$constraints[] = $this->createDateTimeConstraint($query, $settings);
		}

		//archive
		if ($settings['listView']['displayArchived'] && $settings['listView']['displayArchived'] != 'all') {
			$constraints[] = $this->createArchiveConstraint($query, $settings);
		}

		return $constraints;
	}

	/**
	 * dateTime constraints
	 *
	 * @param QueryInterface $query
	 * @param array $settings
	 * @return array
	 */
	protected function createDateTimeConstraint(QueryInterface $query, $settings) {
		$constraints = NULL;
		$dateConstraints = array();
		$today = time();

		//no future posts
		if ($settings['enableFuturePosts'] == 0) {
			$dateConstraints[] = $query->lessThan('date', $today);
		}

		$start = '';
		$stop = '';

		if ($settings['year']) {
			$date = $settings['year'] . '-1-1';
			$start = strtotime($date);
			$stop = strtotime('+1 year', strtotime($date));
		}

		if ($settings['month']) {
			$date = $settings['year'] . '-' . $settings['month'] . '-1';
			$start = strtotime($date);
			$stop = strtotime('+1 month', strtotime($date));
		}

		if ($settings['day']) {
			$date = $settings['year'] . '-' . $settings['month'] . '-' . $settings['day'];
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
	 *
	 * @param QueryInterface $query
	 * @param array $settings
	 * @return array
	 */
	protected function createArchiveConstraint(QueryInterface $query, $settings) {
		$constraints = NULL;
		$archiveConstraints = array();
		$now = $GLOBALS['EXEC_TIME'];

		$archiveMode = $settings['listView']['displayArchived'];

		// daysToArchive
		if ($settings['daysToArchive']) {
			$archiveDate = mktime(0, 0, 0, date('m'), date('d') - (int)$settings['daysToArchive'], date('Y'));

			if ($archiveMode == 'archived') {
				$archiveConstraints[] = $query->logicalOr(
						$query->lessThan('date', $archiveDate),
						$query->logicalAnd(
								$query->greaterThan('archive', 0),
								$query->lessThan('archive', $now)
						)
				);
			} elseif ($archiveMode == 'active') {
				$archiveConstraints[] = $query->greaterThan('date', $archiveDate);
				$archiveConstraints[] = $query->logicalOr(
						$query->greaterThan('archive', $now),
						$query->equals('archive', 0)
				);
			}
		} else {
			if ($archiveMode == 'archived') {
				$archiveConstraints[] = $query->logicalAnd(
						$query->lessThan('archive', $now),
						$query->greaterThan('archive', 0)
				);
			} elseif ($archiveMode == 'active') {
				$archiveConstraints[] = $query->logicalOr(
						$query->greaterThanOrEqual('archive', $now),
						$query->equals('archive', 0)
				);
			}
		}

		if ($archiveConstraints) {
			$constraints = $query->logicalAnd($archiveConstraints);
		}

		return $constraints;
	}

	/**
	 * categorie constraints
	 *
	 * @param QueryInterface $query
	 * @param $settings
	 * @return null|object|\TYPO3\CMS\Extbase\Persistence\Generic\Qom\NotInterface
	 */
	protected function createCategoryConstraint(QueryInterface $query, $settings) {
		$constraint = NULL;
		$categories = NULL;
		$categoryConstraints = array();
		if ($settings['listView']['category']) {
			$categories = GeneralUtility::trimExplode(',', $settings['listView']['category'], TRUE);
		} else {
			$categoryRepository = $this->objectManager->get('\ThomasKieslich\Efblog\Domain\Repository\CategoryRepository');
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

	/**
	 * search constraints
	 *
	 * @param QueryInterface $query
	 * @param array $settings
	 * @return null|object
	 */
	protected function createSearchConstraint(QueryInterface $query, $settings) {

		$constraint = NULL;
		$searchConstraints = array();
		$terms = GeneralUtility::trimExplode(' ', $settings['searchList']['searchPhrase'], TRUE);
		$fields = GeneralUtility::trimExplode(',', $settings['searchList']['searchFields'], TRUE);

		foreach ($terms as $term) {
			foreach ($fields as $field) {
				$searchConstraints[] = $query->like($field, '%' . $term . '%');
			}
		}
		$constraint = $query->logicalOr($searchConstraints);

		return $constraint;
	}

	/**
	 * ordering constraints
	 *
	 * @param $settings
	 * @return array
	 */
	protected function createOrderingsfromSettings($settings) {
		$orderings = array();
		$orderList = GeneralUtility::trimExplode(',', $settings['listView']['orderBy'], TRUE);
		$sortList = GeneralUtility::trimExplode(',', $settings['listView']['sortDirection'], FALSE);

		if (!empty($orderList)) {
			foreach ($orderList as $orderNum => $orderItem) {
				if ($sortList[$orderNum]) {
					$orderings[$orderItem] = ((strtolower($sortList[$orderNum]) == 'desc') ?
							QueryInterface::ORDER_DESCENDING :
							QueryInterface::ORDER_ASCENDING);
				} else {
					$orderings[$orderItem] = QueryInterface::ORDER_ASCENDING;
				}
			}
		}

		return $orderings;
	}

	/**
	 * @param Category $category
	 * @param array $settings
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function countCategoryPosts(Category $category, $settings) {
		$query = $this->createQuery();
		if ($settings['listView']['displayArchived'] && $settings['listView']['displayArchived'] != 'all') {
			$constraints[] = $this->createArchiveConstraint($query, $settings);
		}
		$constraints[] = $query->contains('categories', $category);
		$query->matching(
				$query->logicalAnd($constraints)
		);

		return $query->execute();
	}
}