<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Kieslich <thomas.kieslich@gmail.com> *  	
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
 * ************************************************************* */

/**
 * Controller for the Comments object
 */
class Tx_Efblog_Controller_CommentController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_Efblog_Domain_Repository_CommentRepository
	 */
	protected $commentRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction () {
		$this->commentRepository = $this->objectManager->get('Tx_Efblog_Domain_Repository_CommentRepository');
	}

	/**
	 * Adds a comment to a blog post and redirects to detail view
	 * @param Tx_Efblog_Domain_Model_Post $post
	 * @param Tx_Efblog_Domain_Model_Comment $newComment 
	 * @return void
	 */
	public function createAction (Tx_Efblog_Domain_Model_Post $post, Tx_Efblog_Domain_Model_Comment $newComment) {
		if ($this->settings['comments']['allowComments'] == 1) {
			$spampoints = $this->checkForSpam($newComment);
			$newComment->setIp($_SERVER['REMOTE_ADDR']);
			$newComment->setSpampoints($spampoints);

			if ($spampoints > $this->settings['comments']['spam']['spampointsToHide']) {
				$newComment->setHidden(1);
			}
			if ($spampoints < $this->settings['comments']['spam']['spampointsToDie']) {
				$post->addComment($newComment);
			}


			if ($this->settings['comments']['messageAuthor'] || $this->settings['comments']['messageSuperAdmin']) {
				if ($spampoints < $this->settings['comments']['messageAllSpam']) {
					$this->sendMessage($post, $newComment);
				} elseif ($spampoints < $this->settings['comments']['spam']['spampointsToDie']) {
					$this->sendMessage($post, $newComment);
				}
			}

			$this->flashMessageContainer->add('Your new Comments was created.');
		}

		$this->redirect('detail', 'Post', NULL, array ('post' => $post));
	}

	public function latestCommentsWidgetAction () {
		$this->view->assign('comments', $this->commentRepository->findLatestComments($this->settings));
	}

	protected function checkForSpam ($newComment) {
		$spampoints = 0;
		//check dummy field
		$dummyField = t3lib_div::_POST('tx_Efblog_fe');
		if ($dummyField[newComment][link] > 0) {
			$spampoints += 100;
		}
		//bodycheck
		$message = t3lib_div::strtolower($newComment->getMessage());
		//check body length
		$bodyLength = strlen($message);
		if ($bodyLength < $this->settings['comments']['spam']['bodyLength']) {
			$spampoints += 20;
		}

		//start with
		$messageArray = t3lib_div::trimExplode(' ', $message, TRUE, 500);
		$bodyStartWith = t3lib_div::strtolower($this->settings['comments']['spam']['bodyStartWith']);
		$bodyStartWords = t3lib_div::trimExplode(',', $bodyStartWith, TRUE);
		$firstWord = in_array($messageArray[0], $bodyStartWords);
		if ($firstWord) {
			$spampoints += 10;
		}

		//Keyword search 		
		$keywords = t3lib_div::trimExplode(',', $this->settings['comments']['spam']['keywords'], TRUE);
		$messageArray = array_count_values($messageArray);
		foreach ($keywords as $word) {
			$spampoints += $messageArray[$word] * $this->settings['comments']['spam']['keywordMultiplicator'];
		}

		//link count
		$http = t3lib_div::trimExplode('http://', $message, TRUE);
		$spampoints += count($http) * $this->settings['comments']['spam']['bodyLinkMultiplicator'];
		$www = t3lib_div::trimExplode('www.', $message, TRUE);
		$spampoints += count($www) * $this->settings['comments']['spam']['bodyLinkMultiplicator'];

		//website
		$websiteLength = strlen($newComment->getWebsite());
		if ($websiteLength > $this->settings['comments']['spam']['websiteLength']) {
			$spampoints += $websiteLength - $this->settings['comments']['spam']['websiteLength'];
		}

		//blockedIps
		$ipArray = t3lib_div::trimExplode(',', $this->settings['comments']['spam']['blockedIps'], TRUE);
		$ipBlocked = in_array($_SERVER['REMOTE_ADDR'], $ipArray);
		if ($ipBlocked) {
			$spampoints += $this->settings['comments']['spam']['ipPoints'];
		}

		return $spampoints;
	}

	protected function sendMessage ($post, $newComment) {
		$recipient = array ();
		if ($this->settings['comments']['messageAuthor']) {
			$recipient[] = $post->getAuthor()->getEmail();
		}

		if ($this->settings['comments']['messageSuperAdmin']) {
			$feuserRepository = $this->objectManager->get('Tx_Extbase_Domain_Repository_FrontendUserRepository');
			$superAdmins = $feuserRepository->findByUsergroup((int) $this->settings['superAdminGroup']);
			foreach ($superAdmins as $admin) {
				$recipient[] = $admin->getEmail();
			}
		}

		$sender = $this->settings['comments']['messageSender'];
		$senderName = $this->settings['comments']['messageSenderName'];
		$from = $senderName ? array ($sender => $senderName) : array ($sender);

		$subject = 'new Comment: ' . $post->getTitle();

		//render content
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);

		//html Content
		if ($this->settings['comments']['messageHtml']) {
			$htmlTemplate = $this->settings['comments']['messsageHtmlTemplate'];
			$htmlView = $this->objectManager->create('Tx_Fluid_View_StandaloneView');
			$htmlView->setFormat('html');
			$htmlView->setTemplatePathAndFilename($templateRootPath . $htmlTemplate);
			$htmlView->assignMultiple(array ('newComment' => $newComment, 'post' => $post));
			$htmlContent = $htmlView->render();
		}


		//plaintext content
		$textTemplate = $this->settings['comments']['messsageTextTemplate'];
		$textView = $this->objectManager->create('Tx_Fluid_View_StandaloneView');
		$textView->setFormat('txt');
		$textView->setTemplatePathAndFilename($templateRootPath . $textTemplate);
		$textView->assignMultiple(array ('newComment' => $newComment, 'post' => $post));
		$plainTextContent = $textView->render();

		//Create Mail
		$mailMessage = t3lib_div::makeInstance('t3lib_mail_Message');

		if ($this->settings['comments']['messageHtml']) {
			$mailMessage->setBody($htmlContent, 'text/html');
			$mailMessage->addPart($plainTextContent, 'text/plain');
		} else {
			$mailMessage->setBody($plainTextContent, 'text/plain');
		}

		$mailMessage->setSubject($subject)
			->setFrom($from)
			->setTo($recipient);

		$mailMessage->send();
		return $mailMessage->isSent();
	}

}

?>