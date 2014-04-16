<?php
namespace ThomasKieslich\Efblog\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011-2014 Thomas Kieslich
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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for \ThomasKieslich\Efblog\Domain\Model\Category
 */
class CategoryRepository extends Repository {

	public function findMainCategories($settings) {
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
			array(
				'title' => QueryInterface::ORDER_ASCENDING
			)
		);

		return $query->execute();
	}

	public function findChilds(\ThomasKieslich\Efblog\Domain\Model\Category $category) {
		$query = $this->createQuery();
		$query->matching(
			$query->equals('parent_category', $category)
		);
		$query->setOrderings(
			array(
				'title' => QueryInterface::ORDER_ASCENDING
			)
		);
		return $query->execute();
	}

	protected function createCategoryConstraint(QueryInterface $query, $settings) {
		$constraint = NULL;
		$categoryConstraints = array();
		$categories =  GeneralUtility::trimExplode(',', $settings['listView']['category'], TRUE);

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