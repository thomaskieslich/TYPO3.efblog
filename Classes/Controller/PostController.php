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
use ThomasKieslich\Efblog\Domain\Model\Post;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Controller for the Post object
 */
class PostController extends BaseController {

	/**
	 * list action
	 *
	 * @return void
	 */
	public function listAction() {

		$arguments = $this->request->getArguments();
		if ($arguments) {
			if (isset($arguments['category'])) {
				$this->settings['listView']['category'] = $this->request->getArgument('category');
			}

			if (isset($arguments['searchPhrase'])) {
				$this->settings['listView']['searchPhrase'] = $this->request->getArgument('searchPhrase');
			}

			if (isset($arguments['year'])) {
				$this->settings['year'] = $this->request->getArgument('year');
			}

			if (isset($arguments['month'])) {
				$this->settings['month'] = $this->request->getArgument('month');
			}

			if (isset($arguments['day'])) {
				$this->settings['day'] = $this->request->getArgument('day');
			}
		}

		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));
	}

	/**
	 * post detail
	 *
	 * @param \ThomasKieslich\Efblog\Domain\Model\Post $post
	 * @return void
	 */
	public function detailAction(Post $post = NULL) {

		if ($post) {
			/** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage $content */
			$content = $post->getContent();
			$pages = array();
			$divider = 0;

			foreach ($content as $single) {
				if ($single->getCtype() == $this->settings['detailView']['divType']) {
					$divider++;
					$pages[$divider]['title'] = $single->getHeader();
				}
				if ($single->getCtype() != $this->settings['detailView']['divType']) {
					$pages[$divider]['elements'][] = $single;
				}
			}
			$this->view->assign('pages', $pages);
			$this->view->assign('post', $post);
			$this->view->assign('breadCrumb', $this->createBreadCrumb($post));

			$allowComments = $this->checkAllowComments($post);
			$this->view->assign('allowComments', $allowComments);

			$comments = $this->orderComments($post);
			$this->view->assign('comments', $comments);

			//Update Views
			$this->updateViews($post);

			//render Description
			$this->view->assign('description', $this->createDescription($post, $content));

			//prefill fe_user
			if (isset($GLOBALS['TSFE']) && $GLOBALS['TSFE']->loginUser) {
				$loginUser = $GLOBALS['TSFE']->fe_user->user;
				$feUser = array();
				if ($loginUser['name']) {
					$feUser['name'] = $loginUser['name'];
				} else {
					$feUser['name'] = $loginUser['first_name'] . ' ' . $loginUser['middle_name'] . ' ' . $loginUser['last_name'];
				}
				if ($loginUser['email']) {
					$feUser['email'] = $loginUser['email'];
				}
				if ($loginUser['www']) {
					$feUser['www'] = $loginUser['www'];
				}
				if ($loginUser['city']) {
					$feUser['city'] = $loginUser['city'];
				}

				$this->view->assign('feUser', $feUser);
			}
		} else {
			$this->addFlashMessage(LocalizationUtility::translate('notice_noPost', $this->extensionName));
		}
	}

	/**
	 * return search result
	 *
	 * @return void
	 */
	public function searchListAction() {
		$request = $this->request->getArguments();
		if (isset($request['searchPhrase'])) {
			$searchPhrase = $this->request->getArgument('searchPhrase');
			$this->settings['listView']['searchPhrase'] = $searchPhrase;
			$results = $this->postRepository->findPosts($this->settings);
			$this->view->assign('searchPhrase', $searchPhrase);
			$this->view->assign('posts', $results);
			$this->view->assign('count', $results->count());
		}
	}

	/**
	 * list by category
	 *
	 * @return void
	 */
	public function categoryListAction() {
		$request = $this->request->getArguments();
		if (isset($request['category'])) {
			/** @var \ThomasKieslich\Efblog\Domain\Model\Category $category */
			$category = $this->categoryRepository->findByUid($this->request->getArgument('category'));
			$categories = $this->findSubCategories($category);
			$this->settings['listView']['category'] = $categories;
			$this->view->assign('category', $category);
		}
		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));

		$pagerConfig = array(
				'itemsPerPage' => $this->settings['listView']['itemsPerPage'],
				'insertAbove' => $this->settings['listView']['insertAbove'],
				'insertBelow' => $this->settings['listView']['insertBelow'],
				'maxPages' => $this->settings['listView']['maxPages']
		);
		$this->view->assign('pagerConfig', $pagerConfig);
	}

	/**
	 * show calendar
	 *
	 * @return void
	 */
	public function calendarViewAction() {
	}

	/**
	 * show day
	 *
	 * @return string
	 */
	public function ajaxCalendarDayAction() {
		$this->settings['enableFuturePosts'] = 1;
		$this->settings['listView']['sortDirection'] = 'asc';

		$request = $this->request->getArguments();
		if (isset($request['date'])) {
			$date = date_parse($this->request->getArgument('date'));
			$this->settings['year'] = $date['year'];
			$this->settings['month'] = $date['month'];
			$this->settings['day'] = $date['day'];
		}

		$posts = $this->postRepository->findPosts($this->settings);
		$this->view->assign('date', new \DateTime($this->request->getArgument('date')));
		$this->view->assign('posts', $posts);
		$html = $this->view->render();

		return trim($html);
	}

	/**
	 * show month
	 *
	 * @return string
	 */
	public function ajaxCalendarMonthAction() {
		$this->settings['enableFuturePosts'] = 1;
		$this->settings['listView']['sortDirection'] = 'asc';

		$request = $this->request->getArguments();
		if (isset($request['year'])) {
			$this->settings['year'] = $this->request->getArgument('year');
		}

		if (isset($request['month'])) {
			$this->settings['month'] = $this->request->getArgument('month');
		}

		$monthDates = array();
		foreach ($this->postRepository->findPosts($this->settings) as $mposts) {
			/** @var \DateTime $date */
			$date = $mposts->getDate();
			$date->setTime(12, 00, 00);
			$monthDates[] = $date->format('U') * 1000;
		}

		return json_encode(array_unique($monthDates));
	}

	/**
	 * return list by date
	 *
	 * @return void
	 */
	public function dateListAction() {
		$request = $this->request->getArguments();
		if (isset($request['year'])) {
			$this->settings['year'] = $this->request->getArgument('year');
			$this->view->assign('year', $this->request->getArgument('year'));
		}

		if (isset($request['month'])) {
			$this->settings['month'] = $this->request->getArgument('month');
			$this->view->assign('month', $this->request->getArgument('month'));
		}

		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));

		$pagerConfig = array(
				'itemsPerPage' => $this->settings['listView']['itemsPerPage'],
				'insertAbove' => $this->settings['listView']['insertAbove'],
				'insertBelow' => $this->settings['listView']['insertBelow'],
				'maxPages' => $this->settings['listView']['maxPages']
		);
		$this->view->assign('pagerConfig', $pagerConfig);
	}

	/**
	 * return list from multiple blogs
	 *
	 * @return void
	 */
	public function combinedListAction() {
		$posts = $this->postRepository->findPosts($this->settings);

		$combinedPid = GeneralUtility::trimExplode(',', $this->settings['combinedPid'], TRUE);
		$detailUid = GeneralUtility::trimExplode(',', $this->settings['detailUid'], TRUE);
		$combinedNames = GeneralUtility::trimExplode(',', $this->settings['combinedNames'], TRUE);
		$combinedSettings = array();

		foreach ($combinedPid as $key => $value) {
			$combinedSettings[$value]['pid'] = $combinedPid[$key];
			$combinedSettings[$value]['detail'] = $detailUid[$key];
			$combinedSettings[$value]['name'] = $combinedNames[$key];
		}
		$combinedPosts = GeneralUtility::makeInstance('\TYPO3\CMS\Extbase\Persistence\ObjectStorage');

		foreach ($posts as $post) {
			$post->setDetailUid((int)$combinedSettings[$post->getPid()]['detail']);
			$post->setBlogName($combinedSettings[$post->getPid()]['name']);
			$combinedPosts->attach($post);
		}
		$this->view->assign('posts', $combinedPosts);
	}

	/**
	 * get post RSS
	 *
	 * @return void
	 */
	public function postRssAction() {
		$this->settings['listView']['maxEntries'] = $this->settings['rss']['maxEntries'];
		$posts = $this->postRepository->findPosts($this->settings);
		$rssItems = array();

		$date = 0;
		foreach ($posts as $key => $post) {
			$rssItems[$key]['title'] = $post->getTitle();
			$rssItems[$key]['date'] = $post->getDate();
			$rssItems[$key]['post'] = $post->getUid();
			$rssItems[$key]['comments'] = $post->getComments();
			$rssDate = $post->getDate()->format('U');
			if ($rssDate > $date) {
				$date = $rssDate;
			}
			/** @var \ThomasKieslich\Efblog\Domain\Model\Content $content */
			$content = $post->getContent();
			//render Description
			if ($post->getTeaserDescription()) {
				$description = $post->getTeaserDescription();
			} else {
				$singleCounter = 0;
				/** @var \ThomasKieslich\Efblog\Domain\Model\Content $element */
				/** @var string $description */
				foreach ($content as $element) {
					if ($singleCounter == 0 && $element->getBodytext()) {
						$description = $element->getBodytext();
						$singleCounter++;
					}
				}
			}
			$rssItems[$key]['description'] = strip_tags($description);
			$categories = '';
			/** @var \ThomasKieslich\Efblog\Domain\Model\Category $category */
			foreach ($post->getCategories() as $category) {
				$categories .= $category->getTitle() . ' ';
			}
			$rssItems[$key]['categories'] = $categories;
			$rssItems[$key]['views'] = $post->getViews();
		}
		$this->view->assign('rssItems', $rssItems);
		$this->view->assign('date', date(DATE_RSS, $date));
		$this->view->assign('baseUrl', $GLOBALS['TSFE']->tmpl->setup['config.']['baseURL']);
		$this->view->assign('pid', intval($GLOBALS['TSFE']->id));
	}

	/**
	 * get comments RSS
	 *
	 * @return void
	 */
	public function commentsRssAction() {
		$request = $this->request->getArguments();
		if (isset($request['post'])) {
			$postId = $request['post'];
			$post = $this->postRepository->findByUid((int)$postId);
			$rssItems = array();
			/** @var float $date */
			$date = 0;
			if ($post->getComments()) {
				$comments = $post->getComments()->toArray();
				$comments = array_reverse($comments);
				/** @var \ThomasKieslich\Efblog\Domain\Model\Comment $comment */
				foreach ($comments as $key => $comment) {
					$rssItems[$key]['title'] = $comment->getTitle() . ' ' .
							LocalizationUtility::translate('comment_rss_from', $this->extensionName) . ' ' . $comment->getAuthor();
					$rssItems[$key]['section'] = 'comment_' . $comment->getUid();
					$rssItems[$key]['date'] = $comment->getDate();
					$rssItems[$key]['message'] = $comment->getMessage();
					$rssItems[$key]['post'] = $postId;
					$rssDate = $comment->getDate()->format('U');
					if ($rssDate > $date) {
						$date = $rssDate;
					}
				}
			}

			$this->view->assign('post', $post);
			$this->view->assign('rssItems', $rssItems);
			$this->view->assign('date', date(DATE_RSS, $date));
			$this->view->assign('baseUrl', $GLOBALS['TSFE']->tmpl->setup['config.']['baseURL']);
			$this->view->assign('pid', intval($GLOBALS['TSFE']->id));
		}
	}

	/**
	 * get combined RSS
	 *
	 * @return void
	 */
	public function combinedRssAction() {
		$this->settings['listView']['maxEntries'] = $this->settings['rss']['maxEntries'];
		$posts = $this->postRepository->findPosts($this->settings);

		$combinedPid = GeneralUtility::trimExplode(',', $this->settings['combinedPid'], TRUE);
		$detailUid = GeneralUtility::trimExplode(',', $this->settings['detailUid'], TRUE);
		$combinedNames = GeneralUtility::trimExplode(',', $this->settings['combinedNames'], TRUE);
		$combinedSettings = array();
		foreach ($combinedPid as $key => $value) {
			$combinedSettings[$value]['pid'] = $combinedPid[$key];
			$combinedSettings[$value]['detail'] = $detailUid[$key];
			$combinedSettings[$value]['name'] = $combinedNames[$key];
		}

		$combinedPosts = GeneralUtility::makeInstance('\TYPO3\CMS\Extbase\Persistence\ObjectStorage');
		foreach ($posts as $post) {
			$post->setDetailUid((int)$combinedSettings[$post->getPid()]['detail']);
			$post->setBlogName($combinedSettings[$post->getPid()]['name']);
			$combinedPosts->attach($post);
		}

		$rssItems = array();
		/** @var float $date */
		$date = 0;
		/** @var \ThomasKieslich\Efblog\Domain\Model\Post $post */
		foreach ($combinedPosts as $key => $post) {
			$rssItems[$key]['title'] = $post->getTitle();
			$rssItems[$key]['date'] = $post->getDate();
			$rssItems[$key]['post'] = $post->getUid();
			$rssItems[$key]['comments'] = $post->getComments();
			$rssItems[$key]['detailUid'] = $combinedSettings[$post->getPid()]['detail'];
			$rssDate = $post->getDate()->format('U');
			if ($rssDate > $date) {
				$date = $rssDate;
			}

			/** @var \ThomasKieslich\Efblog\Domain\Model\Content $content */
			$content = $post->getContent();

			$description = '';
			//render Description
			if ($post->getTeaserDescription()) {
				$description = $post->getTeaserDescription();
			} else {
				$singleCounter = 0;
				/** @var \ThomasKieslich\Efblog\Domain\Model\Content $element */
				/** @var string $description */
				foreach ($content as $element) {
					if ($singleCounter == 0 && $element->getBodytext()) {
						$description = $element->getBodytext();
						$singleCounter++;
					}
				}
			}
			$rssItems[$key]['description'] = strip_tags($description);
			$categories = '';

			foreach ($post->getCategories() as $category) {
				$categories .= $category->getTitle() . ' ';
			}
			$rssItems[$key]['categories'] = $categories;
			$rssItems[$key]['views'] = $post->getViews();
		}
		$this->view->assign('rssItems', $rssItems);
		$this->view->assign('date', date(DATE_RSS, $date));
		$this->view->assign('baseUrl', $GLOBALS['TSFE']->tmpl->setup['config.']['baseURL']);
		$this->view->assign('pid', intval($GLOBALS['TSFE']->id));
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
	 * create Breadcrumb
	 *
	 * @param \ThomasKieslich\Efblog\Domain\Model\Post $post
	 * @return array
	 */
	protected function createBreadCrumb($post) {
		$posts = $this->postRepository->findPosts($this->settings)->toArray();
		$breadCrumb = array();
		/** @var  \ThomasKieslich\Efblog\Domain\Model\Post $value */
		foreach ($posts as $key => $value) {
			if ($post->getUid() == $value->getUid()) {
				$breadCrumb[0] = $posts[$key - 1];
				$breadCrumb[1] = $posts[$key + 1];
			}
		}

		return $breadCrumb;
	}

	/**
	 * update Post views
	 *
	 * @param \ThomasKieslich\Efblog\Domain\Model\Post $post
	 */
	protected function updateViews(Post $post) {
		$useragent = strtolower(GeneralUtility::getIndpEnv('HTTP_USER_AGENT'));
		if (!$GLOBALS['BE_USER']->user['uid'] &&
				isset($useragent) &&
				!preg_match('/bot|crawl|slurp|spider/i', $useragent)
		) {
			$currentViews = $post->getViews();
			$post->setViews($currentViews + 1);
			$this->postRepository->update($post);
		}
	}

	/**
	 * create short description
	 *
	 * @param \ThomasKieslich\Efblog\Domain\Model\Post $post
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasKieslich\Efblog\Domain\Model\Content> $content
	 * @return string
	 */
	protected function createDescription($post, $content) {
		$description = '';
		if ($post->getTeaserDescription()) {
			$description = $post->getTeaserDescription();
		} else {
			$singleCounter = 0;
			/** @var \ThomasKieslich\Efblog\Domain\Model\Content $element */
			/** @var string $description */
			foreach ($content as $element) {
				if ($singleCounter == 0 && $element->getBodytext()) {
					$description = $element->getBodytext();
					$singleCounter++;
				}
			}
			$end = '.?!';
			preg_match('/^[^{' . $end . '}]+[{' . $end . '}]/', $description, $sentence);
			if ($sentence[0]) {
				$description = strip_tags($sentence[0]);
			}
		}

		$description = strip_tags($description);

		return $description;
	}

	/**
	 * find Sub categories
	 *
	 * @param \ThomasKieslich\Efblog\Domain\Model\Category $parentCategory
	 * @return string
	 */
	protected function findSubCategories($parentCategory) {
		$subCategories = $parentCategory->getUid();
		$childs = $this->categoryRepository->findChilds($parentCategory);
		if ($childs) {
			/** @var \ThomasKieslich\Efblog\Domain\Model\Category $category */
			foreach ($childs as $category) {
				$subCategories .= ',' . $category->getUid();
				$childs = $this->categoryRepository->findChilds($category);
				if ($childs) {
					/** @var \ThomasKieslich\Efblog\Domain\Model\Category $childCategory */
					foreach ($childs as $childCategory) {
						$subCategories .= ',' . $childCategory->getUid();
					}
				}
			}
		}

		return $subCategories;
	}
}