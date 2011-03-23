<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Thomas Kieslich <thomaskieslich@gmx.net>
*  	
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 3 of the License, or
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
 * Controller for the Comments object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Tkblog_Controller_CommentController extends Tx_Extbase_MVC_Controller_ActionController {
	/**
	 * Creates a new Comment and forwards to the list action.
	 *
	 * @param Tx_Tkblog_Domain_Model_Comment $newComment a fresh Comments object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_Tkblog_Domain_Model_Post $post, Tx_Tkblog_Domain_Model_Comment $newComment) {
		$post->addComment($newComment);
		$this->flashMessageContainer->add('Your new Comments was created.');
		$this->redirect('detail', 'Post', NULL, array('post' => $post));
	}

	/**
	 * action delete
	 *
	 * @return string The rendered delete action
	 */
	public function deleteAction() {

	}

}
?>