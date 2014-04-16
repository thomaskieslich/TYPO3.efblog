<?php
namespace ThomasKieslich\Efblog\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011-2014 Thomas Kieslich
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
use ExtbaseTeam\BlogExample\Domain\Model\Comment;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Controller for the Comments object
 */
class CommentController extends AbstractController {

	/**
	 * @var CommentRepository
	 * @inject
	 */
	protected $commentRepository;


	/**
	 * Adds a comment to a blog post and redirects to detail view
	 *
	 * @param Post $post
	 * @param Comment $newComment
	 * @return void
	 */
	public function createAction(Post $post, Comment $newComment) {
		if ($this->settings['comments']['allowComments'] == 1) {
			$spamcategories = $this->checkForSpam($newComment);
			$newComment->setIp($_SERVER['REMOTE_ADDR']);
			$newComment->setSpamCategories($spamcategories);
			$spampoints = 0;
			foreach ($spamcategories as $key => $value) {
				$spampoints += $value;
			}
			$newComment->setSpampoints($spampoints);

			if ($spampoints > $this->settings['comments']['spam']['spampointsToHide']) {
				$newComment->setHidden(1);
			}
			if ($spampoints < $this->settings['comments']['spam']['spampointsToDie']) {
				$post->addComment($newComment);
			}

			if ($this->settings['comments']['messageAuthor'] || $this->settings['comments']['messageSuperAdmin']) {
				if ($this->settings['comments']['messageAllSpam']) {
					$this->sendMessage($post, $newComment);
				} elseif ($spampoints < $this->settings['comments']['spam']['spampointsToDie']) {
					$this->sendMessage($post, $newComment);
				}
			}

			$this->flashMessageContainer->add('Your new Comments was created.');
		}

		$this->redirect('detail', 'Post', NULL, array('post' => $post));
	}

	public function latestCommentsWidgetAction() {
		$this->view->assign('comments', $this->commentRepository->findLatestComments($this->settings));
	}

	protected function checkForSpam($newComment) {
		$spampoints = array();

		//check dummy field
		$dummyField = GeneralUtility::_POST('tx_efblog_fe');
		if ($dummyField[newComment][link]) {
			$spampoints['dummy'] = 100;
		}

		//author
		$author = GeneralUtility::strtolower($newComment->getAuthor());
		$authorKeywords = GeneralUtility::trimExplode(',', $this->settings['comments']['spam']['authorKeywords'], TRUE);
		$authorPoints = 0;
		foreach ($authorKeywords as $keyword) {
			$authorPoints += substr_count($author, $keyword);
		}
		if ($authorPoints) {
			$spampoints[authorPoints] = $authorPoints * $this->settings['comments']['spam']['authorKeywordsPoints'];
		}

		//email
		$email = GeneralUtility::strtolower($newComment->getEmail());
		if ($email && !substr_count($email, '@')) {
			$spampoints[emailNoAt] = (int)$this->settings['comments']['spam']['emailNoAtPoints'];
		}

		//website
		$websiteLength = strlen($newComment->getWebsite());
		if ($websiteLength > $this->settings['comments']['spam']['websiteLength']) {
			$spampoints[websiteLength] += $websiteLength - $this->settings['comments']['spam']['websiteLengthPoints'];
		}

		//location
		$location = GeneralUtility::strtolower($newComment->getLocation());
		$locationKeywords = GeneralUtility::trimExplode(',', $this->settings['comments']['spam']['locationKeywords'], TRUE);
		$locationPoints = 0;
		foreach ($locationKeywords as $keyword) {
			$locationPoints += substr_count($location, $keyword);
		}
		if ($locationPoints) {
			$spampoints[locationPoints] = $locationPoints * $this->settings['comments']['spam']['locationKeywordsPoints'];
		}

		//title
		$title = GeneralUtility::strtolower($newComment->getTitle());
		$titleKeywords = GeneralUtility::trimExplode(',', $this->settings['comments']['spam']['titleKeywords'], TRUE);
		$titlePoints = 0;
		foreach ($titleKeywords as $keyword) {
			$titlePoints += substr_count($title, $keyword);
		}
		if ($titlePoints) {
			$spampoints[titlePoints] = $titlePoints * $this->settings['comments']['spam']['titleKeywordsPoints'];
		}

		//message
		$message = GeneralUtility::strtolower($newComment->getMessage());

		//message length
		$messageLength = strlen($message);
		if ($messageLength < $this->settings['comments']['spam']['messageLength']) {
			$spampoints[messageLength] += $this->settings['comments']['spam']['messageLengthPoints'];
		}

		//message start with
		$messageArray = GeneralUtility::trimExplode(' ', $message, TRUE, 500);
		$messageStartWith = GeneralUtility::strtolower($this->settings['comments']['spam']['messageStartWith']);
		$messageStartWords = GeneralUtility::trimExplode(',', $messageStartWith, TRUE);
		$firstWord = in_array($messageArray[0], $messageStartWords);
		if ($firstWord) {
			$spampoints[messageStartWith] += $this->settings['comments']['spam']['messageStartWithPoints'];
		}

		//message Keyword search
		$keywords = GeneralUtility::trimExplode(',', $this->settings['comments']['spam']['messageKeywords'], TRUE);
		$keywordPoints = 0;
		foreach ($keywords as $keyword) {
			$keywordPoints += substr_count($message, $keyword);
		}
		if ($keywordPoints) {
			$spampoints[messageKeywords] += $keywordPoints * $this->settings['comments']['spam']['messageKeywordsPoints'];
		}

		//blockedIps
		$ipArray = GeneralUtility::trimExplode(',', $this->settings['comments']['spam']['blockedIps'], TRUE);
		$ipBlocked = in_array($_SERVER['REMOTE_ADDR'], $ipArray);
		if ($ipBlocked) {
			$spampoints += $this->settings['comments']['spam']['ipPoints'];
		}

		return $spampoints;
	}

	protected function sendMessage($post, $newComment) {
		$recipient = array();
		if ($this->settings['comments']['messageAuthor'] && $post->getAuthor()->count() > 0) {
			foreach ($post->getAuthor() as $author) {
				$recipient[] = $author->getEmail();
			}
		}

		if ($this->settings['comments']['messageSuperAdmin']) {
			$feuserRepository = $this->objectManager->get('\ThomasKieslich\Efblog\Domain\Repository\AdministratorRepository');
			$superAdmins = $feuserRepository->findByUsergroup((int)$this->settings['superAdminGroup']);
			if ($superAdmins->count() > 0) {
				foreach ($superAdmins as $admin) {
					$recipient[] = $admin->getEmail();
				}
			}
		}

		$sender = $this->settings['comments']['messageSender'];
		$senderName = $this->settings['comments']['messageSenderName'];
		$from = $senderName ? array($sender => $senderName) : array($sender);

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
			$htmlView->assignMultiple(array('newComment' => $newComment, 'post' => $post));
			$htmlContent = $htmlView->render();
		}

		//plaintext content
		$textTemplate = $this->settings['comments']['messsageTextTemplate'];
		$textView = $this->objectManager->create('Tx_Fluid_View_StandaloneView');
		$textView->setFormat('txt');
		$textView->setTemplatePathAndFilename($templateRootPath . $textTemplate);
		$textView->assignMultiple(array('newComment' => $newComment, 'post' => $post));
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