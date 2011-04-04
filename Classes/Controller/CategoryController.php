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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Controller for the Category object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Tkblog_Controller_CategoryController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_Tkblog_Domain_Repository_CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction () {
		$this->categoryRepository = $this->objectManager->get('Tx_Tkblog_Domain_Repository_CategoryRepository');
	}

	public function categoryOverviewAction () {
		$mainCategories = $this->categoryRepository->findMainCategories($this->settings);
		$this->view->assign('maincategories', $mainCategories);

		$categories = $this->createCategoryTree($mainCategories);
		$this->view->assign('categories', $categories);
		$this->view->assign('dam', t3lib_extMgm::isLoaded('dam'));
	}

	public function categoryWidgetAction () {
		$mainCategories = $this->categoryRepository->findMainCategories($this->settings);
		$categories = $this->createCategoryTree($mainCategories);
		$this->view->assign('categories', $categories);
	}

	protected function createCategoryTree ($mainCategories) {
		$categories = array ();

		foreach ($mainCategories as $key => $category) {
			$categories[$key]['title'] = $category->getTitle();
			$categories[$key]['link'] = $category->getUid();
			$categories[$key]['uid'] = $category->getUid();
			$categories[$key]['posts'] = $category->getPosts();
			$categories[$key]['children'] = $this->findCategoryChilds($category, $key);
		}

		foreach ($categories as $key => $category) {
			$updatedCategory = $this->updateCategoryValues($category);
			$categories[$key] = $updatedCategory;
		}

		return $categories;
	}

	protected function findCategoryChilds ($category, $parent = 0) {
		$child = array ();
		$childs = $this->categoryRepository->findChilds($category);
		if ($childs) {
			foreach ($childs as $key => $category) {
				$child[$key]['title'] = $category->getTitle();
				$child[$key]['link'] = $category->getUid();
				$child[$key]['uid'] = $category->getUid();
				$child[$key]['posts'] = $category->getPosts();
				$child[$key]['parent'] = $parent;
				$child[$key]['children'] = $this->findCategoryChilds($category, $key);
			}
		}
		return $child;
	}

	protected function findCategoryLevels ($categories, $level = 0) {
		$return = $level;
		foreach ($categories as $key => $category) {
			$level_new = $this->findCategoryLevels($category, $level + 1);
			if ($level_new > $return)
				$return = $level_new;
		}
		return $return;
	}

	protected function updateCategoryValues ($category) {
		$categoryLevels = $this->findCategoryLevels($category);
		$levels = ($categoryLevels - 1) / 2;
		if ($levels == 1) {
			$parent = $category;
			$updated = $this->updateCategoryLevel($parent);
			$category = $updated;
		} elseif ($levels == 2) {
			foreach ($category['children'] as $key => $child) {
				if ($child['children']) {
					$parent = $child;
					$updated = $this->updateCategoryLevel($parent);
					$category['children'][$key] = $updated;
				}
			}
			//update Main
			$parent = $category;
			$updated = $this->updateCategoryLevel($parent);
			$category = $updated;
		}
//		t3lib_utility_Debug::debug($category);
		return $category;
	}

	protected function updateCategoryLevel ($parent) {
		foreach ($parent['children'] as $child) {
			$parent['link'] .= ',' . $child['link'];
			$parent['posts'] += $child['posts'];
		}
		return $parent;
	}

}

?>