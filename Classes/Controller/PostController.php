<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Kieslich <thomas.kieslich@gmail.com>
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
 * Controller for the Post object
 */
class Tx_Efblog_Controller_PostController extends Tx_Efblog_Controller_AbstractController {

	/**
	 * @var Tx_Efblog_Domain_Repository_PostRepository
	 */
	protected $postRepository;

	/**
	 *
	 * @param Tx_Efblog_Domain_Repository_PostRepository $postRepository 
	 * @return void
	 */
	public function injectPostRepository(Tx_Efblog_Domain_Repository_PostRepository $postRepository) {
		$this->postRepository = $postRepository;
	}

	/**
	 * list action
	 *
	 * @return string The rendered list action
	 */
	public function listAction() {

		$pagerConfig = array(
			'itemsPerPage' => $this->settings['listView']['itemsPerPage'],
			'insertAbove' => $this->settings['listView']['insertAbove'],
			'insertBelow' => $this->settings['listView']['insertBelow'],
			'maxPages' => $this->settings['listView']['maxPages'],
			'maxItems' => $this->settings['listView']['maxEntries']
		);
		$this->view->assign('pagerConfig', $pagerConfig);


		$request = $this->request->getArguments();
		if (isset($request['category'])) {
			$this->settings['listView']['category'] = $this->request->getArgument('category');
		}

		if (isset($request['searchPhrase'])) {
			$this->settings['listView']['searchPhrase'] = $this->request->getArgument('searchPhrase');
		}

		if (isset($request['year'])) {
			$this->settings['year'] = $this->request->getArgument('year');
		}

		if (isset($request['month'])) {
			$this->settings['month'] = $this->request->getArgument('month');
		}

		if (isset($request['day'])) {
			$this->settings['day'] = $this->request->getArgument('day');
		}

		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));

		$this->view->assign('dam', t3lib_extMgm::isLoaded('dam'));
	}

	/**
	 * post detail
	 * @param Tx_Efblog_Domain_Model_Post $post
	 * @param Tx_Efblog_Domain_Model_Comment $newComment
	 * @return void
	 * @dontvalidate $newComment
	 */
	public function detailAction(Tx_Efblog_Domain_Model_Post $post, Tx_Efblog_Domain_Model_Comment $newComment = NULL) {
		if ($post) {
			$content = $post->getContent();
			$pages = array();
			$divider = 0;

			foreach ($content as $single) {
				if ($single->getCtype() == $this->settings['detailView']['divType']) {
					$divider++;
					$pages[$divider][title] = $single->getHeader();
				}
				if ($single->getCtype() != $this->settings['detailView']['divType']) {
					$pages[$divider][elements][] = $single;
				}
			}
			$this->view->assign('pages', $pages);
			$this->view->assign('post', $post);
			$this->view->assign('dam', t3lib_extMgm::isLoaded('dam'));
			$this->view->assign('breadCrumb', $this->createBreadCrumb($post));

			//get Main Comments
			$commentRepository = $this->objectManager->get('Tx_Efblog_Domain_Repository_CommentRepository');
			$this->view->assign('comments', $commentRepository->findMainComments($post));

			$allowComments = $this->checkAllowComments($post);
			$this->view->assign('allowComments', $allowComments);

			if (!$newComment && $allowComments) {
				$this->view->assign('newComment', $this->prefillCommentForm());
			} elseif ($allowComments) {
				$this->view->assign('newComment', $newComment);
			}

			//Update Views
			$views = $this->updateViews($post);

			//render Description
			$this->view->assign('description', $this->createDescription($post, $content));
		} else {
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('notice_noPost', $this->extensionName), Tx_Extbase_Utility_Localization::translate('notice_error', $this->extensionName), t3lib_Flashmessage::WARNING);
		}
	}

	/**
	 * return search result
	 */
	public function searchListAction() {
		$request = $this->request->getArguments();
		if (isset($request['searchPhrase'])) {
			$this->settings['listView']['searchPhrase'] = $this->request->getArgument('searchPhrase');
			$this->view->assign('searchPhrase', $this->request->getArgument('searchPhrase'));
		}
		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));

		$this->view->assign('dam', t3lib_extMgm::isLoaded('dam'));

		$pagerConfig = array(
			'itemsPerPage' => $this->settings['listView']['itemsPerPage'],
			'insertAbove' => $this->settings['listView']['insertAbove'],
			'insertBelow' => $this->settings['listView']['insertBelow'],
			'maxPages' => $this->settings['listView']['maxPages']
		);
		$this->view->assign('pagerConfig', $pagerConfig);
	}

	/**
	 * list by category
	 */
	public function categoryListAction() {
		$request = $this->request->getArguments();
		if (isset($request['category'])) {
			$categoryRepository = $this->objectManager->get('Tx_Efblog_Domain_Repository_CategoryRepository');
			$category = $categoryRepository->findByUid($this->request->getArgument('category'));
			$categories = $this->findSubCategories($category, $categoryRepository);
			$this->settings['listView']['category'] = $categories;
			$this->view->assign('category', $category);
		}
		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));

		$this->view->assign('dam', t3lib_extMgm::isLoaded('dam'));

		$pagerConfig = array(
			'itemsPerPage' => $this->settings['listView']['itemsPerPage'],
			'insertAbove' => $this->settings['listView']['insertAbove'],
			'insertBelow' => $this->settings['listView']['insertBelow'],
			'maxPages' => $this->settings['listView']['maxPages']
		);
		$this->view->assign('pagerConfig', $pagerConfig);
	}

	public function calendarViewAction() {
		$this->settings['enableFuturePosts'] = 1;
		$this->settings['listView']['sortDirection'] = asc;
		$today = '';

		$request = $this->request->getArguments();
		if (isset($request['date'])) {
			$today = $request['date'] / 1000;
		} else {
			$today = time();
		}

		//month posts
		$this->settings['startDate'] = Null;
		$this->settings['year'] = date('Y', $today);
		$this->settings['month'] = date('m', $today);

		$monthDates = array();
		foreach ($this->postRepository->findPosts($this->settings) as $mposts) {
			$date = $mposts->getDate();
			$monthDates[] = $date->format('d-m-Y');
		}
		$this->view->assign('monthDates', json_encode($monthDates));

		//more posts
		$this->settings['startDate'] = strtotime('+1 day', mktime(0, 0, 0, date('n'), date('j'), date('Y')));
		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));


		$this->settings['startDate'] = Null;
		$this->settings['year'] = date('Y', $today);
		$this->settings['month'] = date('m', $today);
		$this->settings['day'] = date('d', $today);

		$this->view->assign('todayPosts', $this->postRepository->findPosts($this->settings));
		$this->view->assign('thisDay', $today);
	}
	
	public function ajaxCalendarUpdateAction() {
		$this->settings['enableFuturePosts'] = 1;
		$this->settings['listView']['sortDirection'] = asc;
		$this->settings['startDate'] = Null;
		$request = $this->request->getArguments();
		if (isset($request['year'])) {
			$this->settings['year'] = $this->request->getArgument('year');
		}

		if (isset($request['month'])) {
			$this->settings['month'] = $this->request->getArgument('month');
		}
		
		$monthDates = array();
		foreach ($this->postRepository->findPosts($this->settings) as $mposts) {
			$date = $mposts->getDate();
			$monthDates[] = $date->format('d-m-Y');
		}
		return json_encode($monthDates);
	}

	/**
	 * return list by date
	 */
	public function dateMenuListAction() {
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

		$this->view->assign('dam', t3lib_extMgm::isLoaded('dam'));

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
	 */
	public function combinedListAction() {
		$posts = $this->postRepository->findPosts($this->settings);

		$combinedPid = t3lib_div::trimExplode(',', $this->settings['combinedPid'], TRUE);
		$detailUid = t3lib_div::trimExplode(',', $this->settings['detailUid'], TRUE);
		$combinedNames = t3lib_div::trimExplode(',', $this->settings['combinedNames'], TRUE);
		$combinedSettings = array();
		foreach ($combinedPid as $key => $value) {
			$combinedSettings[$value][pid] = $combinedPid[$key];
			$combinedSettings[$value][detail] = $detailUid[$key];
			$combinedSettings[$value][name] = $combinedNames[$key];
		}
		$combinedPosts = new Tx_Extbase_Persistence_ObjectStorage();
		foreach ($posts as $post) {
			$post->setDetailUid((int) $combinedSettings[$post->getPid()][detail]);
			$post->setBlogName($combinedSettings[$post->getPid()][name]);
			$combinedPosts->attach($post);
		}

		$this->view->assign('posts', $combinedPosts);
		$this->view->assign('dam', t3lib_extMgm::isLoaded('dam'));
	}

	/**
	 * return latest posts for widget
	 */
	public function latestPostsWidgetAction() {
		$this->settings['listView']['maxEntries'] = $this->settings['latestPostsWidget']['maxEntries'];
		$this->settings['listView']['orderBy'] = $this->settings['latestPostsWidget']['orderBy'];
		$this->settings['listView']['sortDirection'] = $this->settings['latestPostsWidget']['sortDirection'];
		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));
	}

	/**
	 * return posts with most views
	 */
	public function viewsWidgetAction() {
		$this->settings['listView']['orderBy'] = views;
		$this->settings['listView']['maxEntries'] = $this->settings['viewsWidget']['maxEntries'];
		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));
	}

	/**
	 * return searchform for widget
	 */
	public function searchWidgetAction() {
		
	}

	/**
	 * return posts by date
	 */
	public function dateMenuWidgetAction() {
		$this->settings['listView']['orderBy'] = $this->settings['dateMenuWidget']['orderBy'];
		$this->settings['listView']['sortDirection'] = $this->settings['dateMenuWidget']['sortDirection'];
		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));
	}

	public function postRssAction() {
		$this->settings['listView']['maxEntries'] = $this->settings['rss']['maxEntries'];
		$posts = $this->postRepository->findPosts($this->settings);
		$rssItems = array();

		foreach ($posts as $key => $post) {
			$rssItems[$key]['title'] = $post->getTitle();
			$rssItems[$key]['date'] = $post->getDate();
			$rssItems[$key]['post'] = $post->getUid();
			$rssItems[$key]['comments'] = $post->getComments();

			$content = $post->getContent();
			//render Description
			if ($post->getTeaserDescription()) {
				$description = $post->getTeaserDescription();
			} else {
				$singleCounter = 0;
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
	}

	public function combinedRssAction() {
		$this->settings['listView']['maxEntries'] = $this->settings['rss']['maxEntries'];
		$posts = $this->postRepository->findPosts($this->settings);

		$combinedPid = t3lib_div::trimExplode(',', $this->settings['combinedPid'], TRUE);
		$detailUid = t3lib_div::trimExplode(',', $this->settings['detailUid'], TRUE);
		$combinedNames = t3lib_div::trimExplode(',', $this->settings['combinedNames'], TRUE);
		$combinedSettings = array();
		foreach ($combinedPid as $key => $value) {
			$combinedSettings[$value][pid] = $combinedPid[$key];
			$combinedSettings[$value][detail] = $detailUid[$key];
			$combinedSettings[$value][name] = $combinedNames[$key];
		}

		$combinedPosts = new Tx_Extbase_Persistence_ObjectStorage();
		foreach ($posts as $post) {
			$post->setDetailUid((int) $combinedSettings[$post->getPid()][detail]);
			$post->setBlogName($combinedSettings[$post->getPid()][name]);
			$combinedPosts->attach($post);
		}

		$rssItems = array();

		foreach ($combinedPosts as $key => $post) {
			$rssItems[$key]['title'] = $post->getTitle();
			$rssItems[$key]['date'] = $post->getDate();
			$rssItems[$key]['post'] = $post->getUid();
			$rssItems[$key]['comments'] = $post->getComments();
			$rssItems[$key]['detailUid'] = $combinedSettings[$post->getPid()][detail];

			$content = $post->getContent();
			//render Description
			if ($post->getTeaserDescription()) {
				$description = $post->getTeaserDescription();
			} else {
				$singleCounter = 0;
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
	}

	public function commentsRssAction() {
		$request = $this->request->getArguments();
		if (isset($request['post'])) {
			$postId = $request['post'];
			$post = $this->postRepository->findByUid((int) $postId);
			$rssItems = array();
			if ($post->getComments()) {
				$comments = $post->getComments()->toArray();
				$comments = array_reverse($comments);
				foreach ($comments as $key => $comment) {
					$rssItems[$key]['title'] = $comment->getTitle() . ' ' . Tx_Extbase_Utility_Localization::translate('comment_rss_from', $this->extensionName) . ' ' . $comment->getAuthor();
					$rssItems[$key]['section'] = 'comment_' . $comment->getUid();
					$rssItems[$key]['date'] = $comment->getDate();
					$rssItems[$key]['message'] = $comment->getMessage();
					$rssItems[$key]['post'] = $postId;
				}
			}

			$this->view->assign('post', $post);
			$this->view->assign('server', $_SERVER['SERVER_NAME']);
			$this->view->assign('rssItems', $rssItems);
		}
	}

	protected function prefillCommentForm() {
		$newComment = '';
		if ($GLOBALS['TSFE']->loginUser) {
			$newComment['author'] = $GLOBALS['TSFE']->fe_user->user['name'];
			$newComment['email'] = $GLOBALS['TSFE']->fe_user->user['email'];
			$newComment['website'] = $GLOBALS['TSFE']->fe_user->user['www'];
		}

		$request = $this->request->getArguments();
		if ($request['parentComment'] != '') {
			$newComment['parentComment'] = $this->request->getArgument('parentComment');
			$commentRepository = $this->objectManager->get('Tx_Efblog_Domain_Repository_CommentRepository');
			$parentComment = $commentRepository->findByUid((int) $newComment['parentComment']);
			$extensionName = $this->request->getControllerExtensionName();
			$newComment['title'] = Tx_Extbase_Utility_Localization::translate('comments_reply_prefix', $extensionName) . $parentComment->getTitle();
		}
		return $newComment;
	}

	protected function checkAllowComments($post) {
		$allowComments = FALSE;
		if ($post->getAllowComments() == 0) {
			$allowComments = TRUE;
		}

		if ($this->settings['detailView']['closeCommentsAfter'] > 0) {
			$days = ($this->settings['detailView']['closeCommentsAfter'] * 24 * 60 * 60);
			$postDate = (int) $post->getDate()->format('U');
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
		if (is_array($GLOBALS['TSFE']->fe_user->groupData['uid']) && in_array($this->settings['superAdminGroup'], $GLOBALS['TSFE']->fe_user->groupData['uid'])) {
			$allowComments = TRUE;
		}
		if ($this->settings['comments']['allowComments'] == 0) {
			$allowComments = FALSE;
		}
		return $allowComments;
	}

	protected function createBreadCrumb($post) {
		$posts = $this->postRepository->findPosts($this->settings)->toArray();
		$breadCrumb = array();
		foreach ($posts as $key => $value) {
			if ($post->getUid() == $value->getUid()) {
				$breadCrumb[0] = $posts[$key - 1];
				$breadCrumb[1] = $posts[$key + 1];
			}
		}
		return $breadCrumb;
	}

	protected function updateViews($post) {
		if (!$GLOBALS['BE_USER']->user['uid']) {
			$currentViews = $post->getViews();
			$post->setViews($currentViews + 1);
		}
	}

	protected function createDescription($post, $content) {
		$description = '';
		if ($post->getTeaserDescription()) {
			$description = $post->getTeaserDescription();
		} else {
			$singleCounter = 0;
			foreach ($content as $element) {
				if ($singleCounter == 0 && $element->getBodytext()) {
					$description = $element->getBodytext();
					$singleCounter++;
				}
			}
		}
		$description = strip_tags($description);
		return $description;
	}

	protected function findSubCategories($category, $categoryRepository) {
		$subCategories = $category->getUid();
		$childs = $categoryRepository->findChilds($category);
		if ($childs) {
			foreach ($childs as $category) {
				$subCategories .= ',' . $category->getUid();
				$childs = $categoryRepository->findChilds($category);
				if ($childs) {
					foreach ($childs as $category) {
						$subCategories .= ',' . $category->getUid();
						$childs = $categoryRepository->findChilds($category);
					}
				}
			}
		}
		return $subCategories;
	}

}

?>