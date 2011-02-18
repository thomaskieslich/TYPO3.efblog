<?php
/***************************************************************
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
***************************************************************/

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
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {		
		$this->postRepository = t3lib_div::makeInstance('Tx_Tkblog_Domain_Repository_PostRepository');
	}



	/**
	 * edit posts action
	 *
	 * @return string The rendered list action
	 */
	public function mod1Action() {
		$this->view->assign('posts', $this->postRepository->findAll());
	}
	
	/**
	 * list action
	 *
	 * @return string The rendered list action
	 */
	public function mod2Action() {
		echo 'mod2';
	}
	
	/**
	 * list action
	 *
	 * @return string The rendered list action
	 */
	public function mod3Action() {
		echo 'mod3';
	}
	
}
?>