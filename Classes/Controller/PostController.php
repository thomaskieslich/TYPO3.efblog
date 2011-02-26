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
		$framework = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$this->settings = $framework['settings'];
		$this->persistence = $framework['persistence'];
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

		$this->view->assign('posts', $this->postRepository->findAll());
//		$this->view->assign('posts', $this->postRepository->findPosts(0, 'none'));
		$this->view->assign('backURI', $this->request->getRequestURI());
		$this->view->assign('pageTitle', $GLOBALS['TSFE']->page['title']);
	}

	/**
	 * single post
	 * @param Tx_Tkblog_Domain_Model_Post $post
	 * @param integer $page 
	 */
	public function singleAction(Tx_Tkblog_Domain_Model_Post $post, $page = 1) {
		$pagerEnabled = $this->settings['displaySingle']['pagerEnabled'];
		if ($page == 0) $pagerEnabled = 0;

		$content = $post->getContent();
		$pages = array (1);
		$divider = 2;
		$elements = new Tx_Extbase_Persistence_ObjectStorage();

		if ($pagerEnabled == 1) {
			foreach ($content as $single) {
				if ($single->getCtype() == $this->settings['displaySingle']['divType']) {
					$pages[] = $divider++;
				}
				if ($divider == $page + 1 && $single->getCtype() != $this->settings['displaySingle']['divType']) {
					$elements->attach($single);
				}
			}
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
		$this->view->assign('backURI', $this->request->getArgument('backURI'));
		$this->view->assign('backTitle', $this->request->getArgument('backTitle'));
		$this->view->assign('post', $post);

		//Update Views
		$request = $this->request->getArguments();
		if (isset($request['counter'])) {
			$currentViews = $post->getViews();
			$post->setViews($currentViews + 1);
		}
		
		//render Description
		$singleCounter = 0;
		foreach ($content as $element) {
			if($singleCounter == 0 && $element->getBodytext()){
				$description = $element->getBodytext();
				$singleCounter++;
			}			
		}
		
		$this->view->assign('description', strip_tags($description));
	}

	public function latestWidgetAction() {
		$this->view->assign('pageUri', $this->persistence['storagePid']);
		$this->view->assign('posts', $this->postRepository->findLatest((int) $this->settings['latestWidget']['maxEntrys']));
		$this->view->assign('backURI', $this->request->getRequestURI());
		$this->view->assign('pageTitle', $GLOBALS['TSFE']->page['title']);
	}
	
	public function viewsWidgetAction() {
		$this->view->assign('pageUri', $this->persistence['storagePid']);
		$this->view->assign('posts', $this->postRepository->findViews((int) $this->settings['viewsWidget']['maxEntrys']));
		$this->view->assign('backURI', $this->request->getRequestURI());
		$this->view->assign('pageTitle', $GLOBALS['TSFE']->page['title']);
	}
	
	public function searchWidgetAction(){
		$this->view->assign('posts', $this->postRepository->findAll());
	}

}

?>