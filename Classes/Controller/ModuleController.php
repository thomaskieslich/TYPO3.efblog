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
 * Controller for the BE Module object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Tkblog_Controller_ModuleController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_Tkblog_Domain_Repository_PostRepository
	 */
	protected $postRepository;
	/**
	 * @var Tx_Tkblog_Domain_Repository_PagesRepository
	 */
	protected $pagesRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->postRepository = $this->objectManager->get('Tx_Tkblog_Domain_Repository_PostRepository');
		$this->pagesRepository = $this->objectManager->get('Tx_Tkblog_Domain_Repository_PagesRepository');
		$originalSettings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$this->settings = $originalSettings['settings'];
		$this->persistence = $originalSettings['persistence'];
	}

	public function listAction() {

		$this->view->assign('pages', $this->pagesRepository->findPages());
		if ($this->persistence['storagePid']) {
			$this->view->assign('posts', $this->postRepository->findBeList());
		}
	}

}

?>