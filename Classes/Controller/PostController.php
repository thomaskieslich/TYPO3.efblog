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
 * Controller for the Post object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Tkblog_Controller_PostController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var	array
	 */
	protected $settings;
	/**
	 * @var	array
	 */
	protected $persistence;
	/**
	 * @var Tx_Tkblog_Domain_Repository_PostRepository
	 */
	protected $postRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->postRepository = $this->objectManager->get('Tx_Tkblog_Domain_Repository_PostRepository');
		$framework = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK, 'tkblog', 'tkblog_fe1');
		$originalSettings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);

		// start override
		if (isset($framework['settings']['overrideFlexformSettingsIfEmpty'])) {
			$overrideCategories = t3lib_div::trimExplode(',', $framework['settings']['overrideFlexformSettingsIfEmpty'], TRUE);
			foreach ($overrideCategories as $category) {
				$overrideSettings = t3lib_div::trimExplode('.', $category, TRUE);
				if ((!isset($originalSettings['settings'][$overrideSettings[0]][$overrideSettings[1]]) || empty($originalSettings['settings'][$overrideSettings[0]][$overrideSettings[1]]))
						&& isset($framework['settings'][$overrideSettings[0]][$overrideSettings[1]])) {
					$originalSettings['settings'][$overrideSettings[0]][$overrideSettings[1]] = $framework['settings'][$overrideSettings[0]][$overrideSettings[1]];
				}
			}
		}

		$this->settings = $originalSettings['settings'];
		$this->persistence = $originalSettings['persistence'];
	}

	/**
	 * list action
	 *
	 * @return string The rendered list action
	 */
	public function listAction() {
		$pagerConfig = array (
			'itemsPerPage' => $this->settings['displayList']['itemsPerPage'],
			'insertAbove' => $this->settings['displayList']['insertAbove'],
			'insertBelow' => $this->settings['displayList']['insertBelow'],
			'maxPages' => $this->settings['displayList']['maxPages']
		);
		$this->view->assign('pagerConfig', $pagerConfig);


		$request = $this->request->getArguments();
		$getVars = array ();
		if (isset($request['category'])) {
			$this->settings['displayList']['category'] = $this->request->getArgument('category');
			$getVars['category'] = $this->settings['displayList']['category'];
		}

		if (isset($request['searchPhrase'])) {
			$this->settings['displayList']['searchPhrase'] = $this->request->getArgument('searchPhrase');
			$getVars['searchPhrase'] = $this->settings['displayList']['searchPhrase'];
		}

		if (isset($request['year'])) {
			$this->settings['displayList']['year'] = $this->request->getArgument('year');
			$getVars['year'] = $this->settings['displayList']['year'];
		}

		if (isset($request['month'])) {
			$this->settings['displayList']['month'] = $this->request->getArgument('month');
			$getVars['month'] = $this->settings['displayList']['month'];
		}
		//Paginator
		if (isset($request['__widget_0'])) {
			$getVars['__widget_0'] = $this->request->getArgument('__widget_0');
		}



		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));
		$getVars['backPid'] = $GLOBALS['TSFE']->id;
		$this->view->assign('getVars', $getVars);
	}

	/**
	 * post detail
	 * @param Tx_Tkblog_Domain_Model_Post $post
	 * @param integer $page 
	 * 
	 */
	public function detailAction(Tx_Tkblog_Domain_Model_Post $post = NULL, $page = 1) {
		if ($post) {
			$pagerEnabled = $this->settings['displaySingle']['pagerEnabled'];
			if ($page == 0) $pagerEnabled = 0;

			$content = $post->getContent();
			$pages = array ();
			$pages[1] = '';
			$divider = 2;
			$elements = new Tx_Extbase_Persistence_ObjectStorage();

			if ($pagerEnabled == 1) {
				foreach ($content as $single) {
					if ($single->getCtype() == $this->settings['displaySingle']['divType']) {						
						//$pages[$divider++] = $divider++;
						$pages[$divider++] = $single->getHeader();
//						$divider++;
					}
					if ($divider == $page + 1 && $single->getCtype() != $this->settings['displaySingle']['divType']) {
						$elements->attach($single);
					}
				}
				t3lib_utility_Debug::debug($pages);
			}
			else {
				foreach ($content as $single) {
					if ($this->settings['displaySingle']['hideDivider'] == 1 && $single->getCtype() == $this->settings['displaySingle']['divType']) ;
					else $elements->attach($single);
				}
			}
			$this->view->assign('pages', $pages);
			$this->view->assign('elements', $elements);
			$this->view->assign('pagerEnabled', $pagerEnabled);
			$this->view->assign('page', $page);
			$this->view->assign('post', $post);

			//Update Views

			$request = $this->request->getArguments();
			$getVars = array ();
			if (isset($request['counter'])) {
				$currentViews = $post->getViews();
				$post->setViews($currentViews + 1);
			}

			if (isset($request['category'])) {
				$getVars['category'] = $this->request->getArgument('category');
			}

			if (isset($request['searchPhrase'])) {
				$getVars['searchPhrase'] = $this->request->getArgument('searchPhrase');
			}

			if (isset($request['year'])) {
				$getVars['year'] = $this->request->getArgument('year');
			}

			if (isset($request['month'])) {
				$getVars['month'] = $this->request->getArgument('month');
			}

			if (isset($request['backPid'])) {
				$backPid = $this->request->getArgument('backPid');

				$tmp['L'] = intval(t3lib_div::_GP('L'));
				if ($tmp['L'] > 0) {
					$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('title', 'pages_language_overlay', 'pid = ' . $backPid . ' AND sys_language_uid = ' . $tmp['L']);
				}
				else {
					$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('title', 'pages', 'uid = ' . $backPid);
				}
				$trow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				$this->view->assign('backPid', $backPid);
				$this->view->assign('backTitle', $trow['title']);
			}

			//Paginator
			//Paginator
		if (isset($request['__widget_0'])) {
			$getVars['__widget_0'] = $this->request->getArgument('__widget_0');
		}

			//render Description
			$singleCounter = 0;
			foreach ($content as $element) {
				if ($singleCounter == 0 && $element->getBodytext()) {
					$description = $element->getBodytext();
					$singleCounter++;
				}
			}

			$this->view->assign('description', strip_tags($description));
			
			$this->view->assign('getVars', $getVars);
		}
		else {
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('notice_noPost', $this->extensionName), Tx_Extbase_Utility_Localization::translate('notice_error', $this->extensionName), t3lib_Flashmessage::WARNING);
		}
	}

	public function latestWidgetAction() {
		$target = ($this->settings['latestWidget']['detailUri'] ? $this->settings['latestWidget']['detailUri'] : $this->persistence['storagePid']);
		$this->view->assign('pageUri', $target);
		$this->view->assign('posts', $this->postRepository->findLatest((int) $this->settings['latestWidget']['maxEntrys']));
		$this->view->assign('backPid', $GLOBALS['TSFE']->id);
	}

	public function viewsWidgetAction() {
		$target = ($this->settings['viewsWidget']['detailUri'] ? $this->settings['viewsWidget']['detailUri'] : $this->persistence['storagePid']);
		$this->view->assign('pageUri', $target);
		$this->view->assign('posts', $this->postRepository->findViews((int) $this->settings['viewsWidget']['maxEntrys']));
		$this->view->assign('backPid', $GLOBALS['TSFE']->id);
	}

	public function searchWidgetAction() {
		$target = ($this->settings['searchWidget']['listUri'] ? $this->settings['searchWidget']['listUri'] : $this->persistence['storagePid']);
		$this->view->assign('pageUri', $target);
		$this->view->assign('posts', $this->postRepository->findAll());
	}

	public function categoryWidgetAction() {
		$target = ($this->settings['categoryWidget']['listUri'] ? $this->settings['categoryWidget']['listUri'] : $this->persistence['storagePid']);
		$this->view->assign('pageUri', $target);
		$this->view->assign('posts', $this->postRepository->findAll());
		$categoryRepository = $this->objectManager->get('Tx_Tkblog_Domain_Repository_CategoryRepository');
		$this->view->assign('categories', $categoryRepository->findMainCategory());
	}

	public function dateMenuWidgetAction() {
		$target = ($this->settings['dateMenuWidget']['listUri'] ? $this->settings['dateMenuWidget']['listUri'] : $this->persistence['storagePid']);
		$this->view->assign('pageUri', $target);
		$settings['displayList']['orderBy'] = 'date,time';
		$this->view->assign('posts', $this->postRepository->findPosts($this->settings));
	}

}

?>