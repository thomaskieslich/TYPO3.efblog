<?php
namespace ThomasKieslich\Efblog\Controller;

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

/**
 * Controller for the Widgets
 */
class WidgetController extends BaseController {

	/**
	 * return latest posts for widget
	 *
	 * @return void
	 */
	public function latestPostsWidgetAction() {
		$this->settings['listView']['maxEntries'] = $this->settings['latestPostsWidget']['maxEntries'];
		$this->settings['listView']['orderBy'] = $this->settings['latestPostsWidget']['orderBy'];
		$this->settings['listView']['sortDirection'] = $this->settings['latestPostsWidget']['sortDirection'];
		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));
	}

	/**
	 * Widget with latest comments
	 *
	 * @return void
	 */
	public function latestCommentsWidgetAction() {
		$this->view->assign('comments', $this->commentRepository->findLatestComments($this->settings));
	}

	/**
	 * return posts with most views
	 *
	 * @return void
	 */
	public function viewsWidgetAction() {
		$this->settings['listView']['orderBy'] = 'views';
		$this->settings['listView']['maxEntries'] = $this->settings['viewsWidget']['maxEntries'];
		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));
	}

	/**
	 * category widget
	 *
	 * @return void
	 */
	public function categoryWidgetAction() {
		$query = $this->categoryRepository->findAll()->toArray();
		$categories = array();
		/** @var \ThomasKieslich\Efblog\Domain\Model\Category $category */
		foreach ($query as $key => $category) {
			$categories[$key]['title'] = $category->getTitle();
			$categories[$key]['uid'] = $category->getUid();
			$categories[$key]['posts'] = $this->postRepository->countCategoryPosts($category, $this->settings)->count();
			if ($category->getParentCategory()) {
				$categories[$key]['parentId'] = $category->getParentCategory()->getUid();
			}
		}

		$tree = $this->buildCategoryTree($categories);

		$this->view->assign('categories', $tree);
	}

	/**
	 * return searchform for widget
	 *
	 * @return void
	 */
	public function searchWidgetAction() {
	}

	/**
	 * return posts by date
	 *
	 * @return void
	 */
	public function dateMenuWidgetAction() {
		$this->settings['listView']['orderBy'] = $this->settings['dateMenuWidget']['orderBy'];
		$this->settings['listView']['sortDirection'] = $this->settings['dateMenuWidget']['sortDirection'];
		if ($this->settings['dateMenuWidget']['displayArchived']) {
			$this->settings['listView']['displayArchived'] = $this->settings['dateMenuWidget']['displayArchived'];
		}
		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));
	}
}

