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
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Base Controller
 */
class BaseController extends ActionController {
	/**
	 * @var \ThomasKieslich\Efblog\Domain\Repository\CommentRepository
	 * @inject
	 */
	protected $commentRepository;

	/**
	 * @var \ThomasKieslich\Efblog\Domain\Repository\PostRepository
	 * @inject
	 */
	protected $postRepository;

	/**
	 * @var \ThomasKieslich\Efblog\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository;

	/**
	 * Base init
	 *
	 * @return void
	 */
	public function initializeAction() {
		//set current Pid
		$this->settings['currentPid'] = $GLOBALS['TSFE']->id;
	}

	/**
	 * Build Category Tree
	 *
	 * @param array $elements
	 * @param int $parentId
	 * @return array
	 */
	protected function buildCategoryTree(array $elements, $parentId = 0) {
		$branch = array();

		foreach ($elements as $element) {
			if ($element['parentId'] == $parentId) {
				$children = $this->buildCategoryTree($elements, $element['uid']);
				if ($children) {
					$element['children'] = $children;
				}
				$branch[] = $element;
			}
		}

		return $branch;
	}

	/**
	 * check comments allowed
	 *
	 * @param \ThomasKieslich\Efblog\Domain\Model\Post $post
	 * @return bool
	 */
	protected function checkAllowComments($post) {
		$allowComments = FALSE;
		if ($post->getAllowComments() == 0) {
			$allowComments = TRUE;
		}

		if ($this->settings['detailView']['closeCommentsAfter'] > 0) {
			$days = ($this->settings['detailView']['closeCommentsAfter'] * 24 * 60 * 60);
			$postDate = (int)$post->getDate()->format('U');
			if (($postDate + $days) > time()) {
				$allowComments = TRUE;
			} else {
				$allowComments = FALSE;
			}
		}

		if ($post->getAllowComments() == 1 || $this->settings['detailView']['closeCommentsAfter'] < 0) {
			$allowComments = FALSE;
		}

		if ($post->getAllowComments() == 2) {
			$allowComments = TRUE;
		}

		if ($post->getAllowComments() == 3 && isset($GLOBALS['TSFE']) && $GLOBALS['TSFE']->loginUser) {
			$allowComments = TRUE;
		}

		//Post Owner
		foreach ($post->getAuthor() as $author) {
			if ($author && $GLOBALS['TSFE']->fe_user->user['uid'] == $author->getUid()) {
				$allowComments = TRUE;
			}
		}

		//Superadmin
		if (is_array($GLOBALS['TSFE']->fe_user->groupData['uid']) &&
				in_array($this->settings['superAdminGroup'], $GLOBALS['TSFE']->fe_user->groupData['uid'])
		) {
			$allowComments = TRUE;
		}
		if ($this->settings['comments']['allowComments'] == 0) {
			$allowComments = FALSE;
		}

		return $allowComments;
	}

	/**
	 * Order Comments
	 *
	 * @param \ThomasKieslich\Efblog\Domain\Model\Post $post
	 *
	 * @return array
	 */
	protected function orderComments($post) {
		$comments = array();
		$mainComments = $this->commentRepository->findMainComments($post)->toArray();

		foreach ($mainComments as $key => $mainComment) {
			$childs = $this->commentRepository->findAllChildren($mainComment)->toArray();
			$comments[$key]['main'] = $mainComment;
			if ($childs) {
				$comments[$key]['childs'] = $childs;
			}
		}

		return $comments;
	}
}